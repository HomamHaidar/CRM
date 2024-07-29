<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealRequest;
use App\Kanban\TaskKanban;
use App\Models\Client;
use App\Models\Company;
use App\Models\Deal;
use App\Models\Journey;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskKanban $kanban)
    {
        $deals=Deal::all();
        $journeys = Journey::with('stages.deals')->get();

        return view('Deal.index', compact('journeys'));


    }
    public function get(TaskKanban $kanban)
    {
        return $kanban->render('kanban');
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
        $journeys=Journey::all();
        return view('Deal.create',compact('users','companies','clients','products','journeys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DealRequest $request)
    {
      $validated=$request->validated();

        $deal=Deal::create($validated);
        $deal->users()->attach($request->users_in);
        $j=Journey::findOrFail($deal->journey_id);
       $deal["stage_id"]=$j->stages[0]->id  ;
        $deal->save();

        toastr()->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('deal');
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
    public function updateDealStatus(Request $request)
    {
        $validated = $request->validate([
            'deal_id' => 'required|exists:deals,id',
            'stage_id' => 'required|exists:stages,id',
        ]);

        $deal = Deal::find($validated['deal_id']);
        $deal->stage_id = $validated['stage_id'];
        $deal->save();

        return response()->json(['success' => true]);
    }
    public function update(Request $request, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
    }
}
