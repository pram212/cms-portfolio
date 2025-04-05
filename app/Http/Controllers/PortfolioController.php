<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Services\SupabaseStorageService;

class PortfolioController extends Controller
{

    protected $supabaseService;

    public function __construct(SupabaseStorageService $supabaseService)
    {
        $this->supabaseService = $supabaseService;
    }

    public function page()
    {
        $portfolios = Portfolio::select('id', 'project_title', 'images')->get();
        return Inertia::render('Portfolio', compact('portfolios'));
    }

    public function pageDetail($id)
    {
        $portfolio = Portfolio::find($id);
        return Inertia::render('PortfolioDetail', compact('portfolio'));
    }

    public function index()
    {
        $portfolios = Portfolio::orderBy("start", "asc")->paginate(10)->withQueryString();
        return Inertia::render('CMS/IndexPortfolio', compact('portfolios'));
    }

    public function create()
    {
        return Inertia::render('CMS/FormPortfolio');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_title' => ['required'],
            'type' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['date', 'nullable'],
            'images_file' => ['required', 'array'],
            'description' => ['required', 'string'],
        ]);

        try {
            DB::beginTransaction();

            if ($request->file('images_file')) {
                $imagePaths = [];
                foreach ($request->file('images_file') as $key => $item) {
                    $file = $item['file'];
                    $path = $this->supabaseService->upload($file);
                    // $path = $file->storeAs(
                    //     'photos', // folder name
                    //     $file->hashName(), // file name with hash
                    //     'public' // disk
                    // );
                    array_push($imagePaths, $path);
                }

                $request->merge(['images' => $imagePaths]);
            }

            $request->merge([
                'images' => json_encode($request->images),
            ]);

            Portfolio::create($request->all());

            DB::commit();

            return Redirect::route('portfolios.index')->with([
                'type' => 'success',
                'message' => 'Data Saved Succesfully'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
            return back()->with([
                'type' => 'error',
                "message" =>  $ex->getMessage() . " at line " . $ex->getLine()
            ]);
        }
    }

    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        return Inertia::render('CMS/FormPortfolio', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_title' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['date', 'nullable'],
            'images_file' => ['required', 'array'],
            'description' => ['required', 'string'],
        ]);

        try {
            DB::beginTransaction();
            // get image paths existing from request with key "path"
            $imageExisting = collect($request->images_file)->where('path', '!=', null)->pluck('path');
            // check if the request contains new file
            if ($request->file('images_file')) {
                foreach ($request->file('images_file') as $key => $item) {
                    // upload new file
                    $file = $item['file'];
                    $path = $this->supabaseService->upload($file);

                    // $path = $file->storeAs(
                    //     'photos', // folder name
                    //     $file->hashName(), // file name with hash
                    //     'public' // disk
                    // );

                    $imageExisting->push($path);
                }
                // add new key in the request for new image paths
                $request->merge(['images' => $imageExisting]);
            }

            $portfolio = Portfolio::find($id);

            $portfolio->update($request->all());

            DB::commit();

            return Redirect::route('portfolios.index')->with([
                'type' => 'success',
                'message' => 'Data Updated Successfully'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();

            return back()->with([
                'type' => 'error',
                "message" =>  $ex->getMessage() . " at line " . $ex->getLine()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Portfolio::destroy($id);

            DB::commit();

            return Redirect::route('portfolios.index')->with([
                'type' => 'success',
                'message' => 'Data Deleted Successfully'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();

            return back()->with([
                'type' => 'error',
                "message" =>  $ex->getMessage() . " at line " . $ex->getLine()
            ]);
        }
    }
}
