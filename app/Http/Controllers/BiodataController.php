<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;
class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biodata = Biodata::first();
        return Inertia::render('CMS/Biodata', compact('biodata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'title' => ['required'],
            'summary' => ['required'],
            'birthday' => ['required'],
        ]);

        if ($request->file('req_photo')) {
            $file = $request->file('req_photo');
            $imagePath = "/storage/" . $file->storeAs('public/photos', time() . $request->file('req_photo')->getClientOriginalName());
            $request->merge(['photo' => Str::remove('public/', $imagePath)]);
        }

        if ($request->file('req_photo2')) {
            $file = $request->file('req_photo2');
            $imagePath = "/storage/" . $file->storeAs('public/photos', time() . $request->file('req_photo2')->getClientOriginalName());
            $request->merge(['photo2' => Str::remove('public/', $imagePath)]);
        }

        try {
            DB::beginTransaction();

            Biodata::updateOrCreate(['id' => 1], $request->except(['req_photo', 'req_photo2']));
            
            DB::commit();

            return redirect()->route('biodata.index')->with([
                'type' => 'success',
                'message' => 'Data berhasil diubah'
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
    public function destroy(string $id)
    {
        //
    }
}
