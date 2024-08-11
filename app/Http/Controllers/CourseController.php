<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(7)->withQueryString();
        return Inertia::render('CMS/IndexCourse', compact('courses'));
    }

    public function create()
    {
        return Inertia::render('CMS/FormCourse');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'description' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            Course::create($request->all());

            DB::commit();

            return Redirect::route('courses.index')->with([
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
        $course = Course::find($id);
        return Inertia::render('CMS/FormCourse', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'institution' => ['required'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'description' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            
            $course = Course::find($id);

            $course->update($request->all());

            DB::commit();

            return Redirect::route('courses.index')->with([
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

            Course::destroy($id);

            DB::commit();

            return Redirect::route('courses.index')->with([
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
