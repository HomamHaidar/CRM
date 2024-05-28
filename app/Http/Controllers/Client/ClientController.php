<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=Client::with('company')->get();
        return view('Client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $source = $request->query('source', '');


        $lead = ($source === 'select_option');

        $companies=Company::all();
        return view('Client.create',compact('companies','lead'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {

        $validated=$request->validated();
        Client::create($validated);
        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('client');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('Client.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {   $companies=Company::all();
        return view('Client.edit',compact('client','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {

        $validated= $request->validated();

       $client->update($validated);
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.','تحديث');
        return redirect('client/'.$client->id);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');
        return redirect('client');
    }
}
