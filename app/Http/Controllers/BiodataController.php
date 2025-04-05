<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Services\SupabaseStorageService;


class BiodataController extends Controller
{
    protected $supabaseService;
    /**
     * Create a new controller instance.
     *
     * @param SupabaseStorageService $supabaseService
     */
    public function __construct(SupabaseStorageService $supabaseService)
    {
        $this->supabaseService = $supabaseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biodata = Biodata::first();
        return Inertia::render('CMS/Biodata', compact('biodata'));
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
            $path = $this->supabaseService->upload($request->file('req_photo'), "photos/");

            // $path = $request->file('req_photo')->storeAs(
            //     'photos', // folder name
            //     $request->file('req_photo')->hashName(), // file name with hash
            //     'public' // disk
            // );

            $request->merge(['photo' => $path]);
        }

        if ($request->file('req_photo2')) {
            $path = $this->supabaseService->upload($request->file('req_photo2'), "photos/");
            // $path = $request->file('req_photo2')->storeAs(
            //     'photos', // folder name
            //     $request->file('req_photo2')->hashName(), // file name with hash
            //     'public' // disk
            // );

            $request->merge(['photo2' => $path]);
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
                'type' => 'error',
                "message" =>  $ex->getMessage() . " at line " . $ex->getLine()
            ]);
        }
    }
}
