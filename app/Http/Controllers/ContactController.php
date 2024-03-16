<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function page()
    {
        $contact = Contact::first();

        return Inertia::render('Contact', compact('contact'));
    }

    public function index() 
    {
        $contact = Contact::first();
        return Inertia::render('CMS/FormContact', compact('contact'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => ['required'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email'],
        ]);
        
        try {
            DB::beginTransaction();

            Contact::updateOrCreate(['id' => 1], $request->all());
            
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
