<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::paginate(20)->withQueryString();
        return Inertia::render('CMS/IndexSkill', compact('skills'));
    }

    public function create()
    {
        return Inertia::render('CMS/FormSkill');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('skills')],
            'presentage' => ['numeric'],
        ]);

        try {
            DB::beginTransaction();

            Skill::create($request->all());

            DB::commit();

            return Redirect::route('skills.index')->with([
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
        $skill = Skill::find($id);
        return Inertia::render('CMS/FormSkill', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::find($id);
        $request->validate([
            'name' => ['required', Rule::unique('skills')->ignore($id)],
            'presentage' => ['numeric'],
        ]);

        try {
            DB::beginTransaction();
            
            $skill = Skill::find($id);

            $skill->update($request->all());

            DB::commit();

            return Redirect::route('skills.index')->with([
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

            Skill::destroy($id);

            DB::commit();

            return Redirect::route('skills.index')->with([
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
