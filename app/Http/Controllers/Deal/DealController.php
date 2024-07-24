<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\Deal;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals=Deal::all();
        return view('Deal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
        $companies=Company::all();
        $clients=Client::all();
        $products=Product::all();
        return view('Deal.create',compact('users','companies','clients','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DealRequest $request)
    {
      $validated=$request->validated();

        $deal=Deal::create($validated);
        $deal->users()->attach($request->users_in);
        toastr()->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('activity');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        //
    }
}
