<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::paginate(10)->withQueryString();
        return Inertia::render('CMS/IndexEducation', compact('educations'));
    }

    public function create()
    {
        return Inertia::render('CMS/FormEducation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'title' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            Education::create($request->all());

            DB::commit();

            return Redirect::route('cms.about.educations.index')->with([
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
        $education = Education::find($id);
        return Inertia::render('CMS/FormEducation', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'institution' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            'title' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            
            $education = Education::find($id);

            $education->update($request->all());

            DB::commit();

            return Redirect::route('cms.about.educations.index')->with([
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

            Education::destroy($id);

            DB::commit();

            return Redirect::route('cms.about.educations.index')->with([
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
