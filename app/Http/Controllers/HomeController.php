<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function page()
    {
        $biodata = Biodata::find(1);
        return Inertia::render('Home', compact('biodata'));
    }

    public function index() 
    {
        $biodata = Biodata::find(1);
        return Inertia::render('CMS/Home', compact('biodata'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'passion' => ['required']
        ]);

        if ($request->file('photo_file')) {
            $file = $request->file('photo_file');
            $imagePath = "/storage/" . $file->storeAs('public/images', time() . $request->file('photo_file')->getClientOriginalName());
            $request->merge(['photo' => Str::remove('public/', $imagePath)]);
        }
        
        try {
            DB::beginTransaction();

            Biodata::updateOrCreate(['id' => 1], $request->except('photo_file'));
            
            DB::commit();

            return redirect()->route('cms.home.index')->with([
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
}
