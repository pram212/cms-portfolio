<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10)->withQueryString();
        return Inertia::render('CMS/IndexClient', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CMS/FormClient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company' => ['required'],
            'logo_file' => ['required'],
        ]);

        try {

            if ($request->file('logo_file')) {
                $file = $request->file('logo_file');
                $imagePath = "/storage/" . $file->storeAs('public/client', time() . $request->file('logo_file')->getClientOriginalName());
                $request->merge(['logo' => Str::remove('public/', $imagePath)]);
            }

            DB::beginTransaction();

            Client::create($request->except('logo_file'));

            DB::commit();

            return Redirect::route('clients.index')->with([
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

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return Inertia::render('CMS/FormClient', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'company' => ['required'],
            'logo_file' => ['required'],
        ]);

        try {
            
            if ($request->file('logo_file')) {
                $file = $request->file('logo_file');
                $imagePath = "/storage/" . $file->storeAs('public/client', time() . $request->file('logo_file')->getClientOriginalName());
                $request->merge(['logo' => Str::remove('public/', $imagePath)]);
            }

            DB::beginTransaction();

            $client->update($request->except('logo_file'));

            DB::commit();

            return Redirect::route('clients.index')->with([
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            DB::beginTransaction();

            $client->delete();

            DB::commit();

            return Redirect::route('clients.index')->with([
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
