<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Service;
use App\Models\About;
use App\Models\Course;
use App\Models\Experience;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function page()
    {
        $educations = Education::all();
        $courses = Course::all();
        $skills = Skill::all();
        $services = Service::all();
        $about = About::first();
        $experiences = Experience::all();

        return Inertia::render('About', compact('educations', 'courses', 'skills', 'services', 'about', 'experiences'));
    }

    public function index() 
    {
        $about = About::find(1);
        return Inertia::render('CMS/FormAbout', compact('about'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'bio' => ['required'],
        ]);
        
        try {
            DB::beginTransaction();

            About::updateOrCreate(['id' => 1], ['bio' => $request->bio ]);
            
            DB::commit();

            return redirect()->back()->with([
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
