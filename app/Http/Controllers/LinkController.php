<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::paginate(10)->withQueryString();
        return Inertia::render('CMS/IndexLink', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CMS/FormLink');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'url' => ['required', 'url:http,https'],
            'svg' => ['required', 'string'],
            'icon_font' => ['string', 'nullable'],
            'color' => ['required', 'string'],
        ]);

        try {
            DB::beginTransaction();

            Link::create($request->all());

            DB::commit();

            return Redirect::route('links.index')->with([
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

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        return Inertia::render('CMS/FormLink', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $request->validate([
            'name' => ['required'],
            'url' => ['required', 'url:http,https'],
            'svg' => ['required', 'string'],
            'icon_font' => ['string', 'nullable'],
            'color' => ['required', 'string'],
        ]);

        try {
            DB::beginTransaction();

            $link->update($request->all());

            DB::commit();

            return Redirect::route('links.index')->with([
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        try {
            DB::beginTransaction();

            $link->delete();

            DB::commit();

            return Redirect::route('links.index')->with([
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
