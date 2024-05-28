<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads=Client::where('islead',1)->with('company')->get();
        $clients=Client::where('islead',0)->with('company')->get();

        return view('Lead.index',compact('leads','clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $client=Client::findOrFail($id);

        return view('Lead.show',compact('client'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client=Client::findOrFail($id);
        $client->islead=0;
        $client->save();

        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.','تحديث');
        return redirect('index_lead');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $client= Client::findOrFail($request->client_id);
        $client->islead=1;
        $client->save();
        return redirect('index_lead');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
