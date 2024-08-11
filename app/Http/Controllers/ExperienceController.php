<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::paginate(10)->withQueryString();
        return Inertia::render('CMS/IndexExperience', compact('experiences'));
    }

    public function create()
    {
        return Inertia::render('CMS/FormExperience');
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

            Experience::create($request->all());

            DB::commit();

            return Redirect::route('experiences.index')->with([
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
        $experience = Experience::find($id);
        return Inertia::render('CMS/FormExperience', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['date', 'nullable'],
            'position' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            
            $experience = Experience::find($id);

            $experience->update($request->all());

            DB::commit();

            return Redirect::route('experiences.index')->with([
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

            Experience::destroy($id);

            DB::commit();

            return Redirect::route('experiences.index')->with([
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
