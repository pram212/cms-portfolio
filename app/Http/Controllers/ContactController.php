<?php

namespace App\Http\Controllers;

use App\Mail\NotifMessage;
use App\Mail\SendMessage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

    public function sendMessage(Request $request) 
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string']
        ]);

        Mail::to("pramono6236@gmail.com")->send(new SendMessage( $request->message, $request->email, $request->name ));
        Mail::to($request->email)->send(new NotifMessage($request->name));

        return back()->with([
            'type' => 'success',
            'message' => 'Pesan berhasil dikirim'
        ]);
    }

}
