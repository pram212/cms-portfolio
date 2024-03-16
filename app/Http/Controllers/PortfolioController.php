<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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
            'company' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['date', 'nullable'],
            'position' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            Portfolio::create($request->all());

            DB::commit();

            return Redirect::route('cms.about.portfolios.index')->with([
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
        dd($request->all());
        
        $request->validate([
            'company' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['date', 'nullable'],
            'position' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            
            $experience = Portfolio::find($id);

            $experience->update($request->all());

            DB::commit();

            return Redirect::route('cms.about.portfolios.index')->with([
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

            return Redirect::route('cms.about.portfolios.index')->with([
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
