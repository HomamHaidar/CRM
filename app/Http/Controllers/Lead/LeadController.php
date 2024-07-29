<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Client;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Client::where('islead', 1)->with('company')->get();
        $clients = Client::where('islead', 0)->with('company')->get();

        return view('Lead.index', compact('leads', 'clients'));
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

        $client = Client::findOrFail($id);

        $users = $client->user;
        $activities=  $client->activities;

        return view('Lead.show', compact('client', 'users','activities'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        $client->islead = 0;
        $client->save();

        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
        return redirect('index_lead');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        $client->islead = 1;
        $client->save();
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
        return redirect('index_lead');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore_client(string $id)
    {
        if ($won=Client::find($id) and $won->where('status',1)){
            $won->status=null;
            $won->why_status=null;
            $won->islead=1;
            $won->save();
            toastr()
                ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
            return redirect('index_lead');
        }

        $lead=Client::onlyTrashed()->where('id',$id)->restore();
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
        return redirect('index_lead');
    }

    public function lead_archive(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $status=0;
        if ($request->status=="فوز"){
            $status=1;
        }

        $client->update([
            'status' =>$status,
            'why_status' => $request->why_status
        ]);

        if ($status==0){
            $client->delete();
        }
        else{
            $client->islead=0;
            $client->save();
        }

        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
        return redirect('index_lead');

    }

    public function index_archive(){

       $clients= Client::onlyTrashed()->get();
       $won=Client::where('status',1)->get();
       return view('Lead.archive',compact('clients','won'));
    }
}
