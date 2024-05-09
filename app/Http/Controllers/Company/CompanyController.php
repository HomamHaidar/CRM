<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies=Company::all();
        return view('Company.index',compact('companies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Company.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $request->validated();
        Company::create([
            'name'=>$request->name,
            'field'=>$request->field,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'note'=>$request->note,
        ]);
        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('company');


    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
            return view('company.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit',compact('company'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $request->validated();
        $company->update([
            'name'=>$request->name,
            'field'=>$request->field,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'note'=>$request->note,
        ]);
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.','تحديث');
        return redirect('company');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');
        return redirect('company');
    }
}
