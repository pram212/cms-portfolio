<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
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
        $portfolios = Portfolio::paginate(10)->withQueryString();
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
            'start' => ['required', 'date'],
            'end' => ['date', 'nullable'],
            'technologies' => ['required', 'array'],
            'images_file' => ['required', 'array'],
            'modules' => ['required', 'array'],
            'description' => ['required', 'string'],
            'demo' => ['required'],
        ]);

        
        try {
            DB::beginTransaction();

            if ($request->file('images_file')) {
                $imagePaths = [];
                foreach ($request->file('images_file') as $key => $item) {
                    $file = $item['file'];
                    $storagePath = "/storage/" . $file->storeAs('public/portfolio_images', time() . $file->getClientOriginalName());
                    array_push($imagePaths, Str::remove('public/', $storagePath));
                }
                $request->merge(['images' => $imagePaths ]);
            }

            Portfolio::create([
                'project_title' => $request->project_title,
                'start' => $request->start,
                'end' => $request->end,
                'description' => $request->description,
                'technologies' => json_encode($request->technologies),
                'images' => json_encode($request->images),
                'modules' => json_encode($request->modules),
                'demo' => json_encode($request->demo),
            ]);

            DB::commit();

            return Redirect::route('portfolios.index')->with([
                'type' => 'success',
                'message' => 'Data Saved Succesfully'
            ]);
            
        } catch (\Exception $ex) {
            DB::rollBack();

            return back()->with([
                'type' => 'error', "message" =>  $ex->getMessage() . " at line " . $ex->getLine()
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
            'technologies' => ['required', 'array'],
            'images_file' => ['required', 'array'],
            'modules' => ['required', 'array'],
            'description' => ['required', 'string'],
            'demo' => ['required'],
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
                    $storagePath = "/storage/" . $file->storeAs('public/portfolio_images', time() . $file->getClientOriginalName());
                    // update image path existing with path of file uploaded
                    $imageExisting->push(Str::remove('public/', $storagePath));
                }
                // add new key in the request for new image paths
                $request->merge(['images' => $imageExisting ]);
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
                'type' => 'error', "message" =>  $ex->getMessage() . " at line " . $ex->getLine()
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
                'type' => 'error', "message" =>  $ex->getMessage() . " at line " . $ex->getLine()
            ]);
        }
    }
}
