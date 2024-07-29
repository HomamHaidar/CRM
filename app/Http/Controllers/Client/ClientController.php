<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=Client::with('company')->get();
        $users=User::all();
        return view('Client.index',compact('clients','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $source = $request->query('source', '');


        $lead = ($source === 'select_option');
        $users=User::all();
        $companies=Company::all();
        return view('Client.create',compact('companies','lead','users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {

        $validated=$request->validated();


        if ($validated['company_id']=='null'){
            $validated['company_id']=null;
        }
        $client=Client::create($validated);

        $client->user()->attach($validated['user_id']);
        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('client');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $users= $client->user;


        return view('Client.show',compact('client','users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {   $companies=Company::all();
        $users=User::all();
        return view('Client.edit',compact('client','companies','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {

        $validated= $request->validated();
        if ($validated['company_id']=='null'){
            $validated['company_id']=null;
        }

       $client->update($validated);
        $client->user()->sync($validated['user_id']);
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.','تحديث');
        return redirect('client/'.$client->id);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {

        $client->forceDelete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');
        return redirect('client');
    }
}
