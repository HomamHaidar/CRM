<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealRequest;
use App\Kanban\TaskKanban;
use App\Models\Activity;
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
        $clients=Client::all();
        $products=Product::all();
        $journeys=Journey::all();
        return view('Deal.create',compact('users','clients','products','journeys'));
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
        $activities= Activity::where('deal_id',$deal->id)->get();
        $users=User::all();
        return view('deal.show',compact('deal','activities','users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        $users=User::all();
        $clients=Client::all();
        $products=Product::all();
        $journeys=Journey::all();
        return view('deal.edit',compact('deal','users','clients','products','journeys'));
    }
    public function updateDealStatus(Request $request,$id)
    {
        $deal=Deal::findOrFail($id);
       if ($request->perv){
           $deal['stage_id']-=1;
           $deal->save();
           $deal->save();
       } if ($request->next){
            $deal['stage_id']+=1;
           $deal->save();
       }
        toastr()
            ->addInfo('تم تحديث البيانات بنجاح.','تحديث');
        return redirect('deal');
    }


    public function update(DealRequest $request, Deal $deal)
    {
        $validated=$request->validated();



        $deal->update($validated);

        $deal->users()->sync($validated['users_in']);

        $j=Journey::findOrFail($validated["journey_id"]);

        $deal["stage_id"]=$j->stages[0]->id ;

        $deal->save();

        toastr()
            ->addInfo('تم تحديث البيانات بنجاح.','تحديث');
        return redirect('deal');
    }

    public function deal_archive(Request $request, $id)
    {
        $deal = Deal::findOrFail($id);
        $status=0;
        if ($request->status=="فوز"){
            $status=1;
            $deal->update([
                'status' =>$status,
                'reason' => $request->why_status,
                'end'=>now()
            ]);
            $product=Product::findOrFail($deal->product->id);
            $product->quantity-= $deal->quantity;
            $product->save();
            $deal->delete();
            toastr()
                ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
            return redirect('deal');
        }
        else{
            $status=0;
            $deal->update([
                'status' =>$status,
                'end'=>now(),
                'reason' => $request->why_status,
            ]);
            $deal->delete();
            toastr()
                ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
            return redirect('deal');
        }


    }

    public function index_archive(){

        $deals= Deal::onlyTrashed()->get();
        return view('deal.archive',compact('deals'));
    }

    public function restore_client(string $id)
    {


        $deal=Deal::onlyTrashed()->where('id',$id)->restore();
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.', 'تحديث');
        return redirect('deal');
    }

    public function destroy(Deal $deal)
    {
        $deal->forceDelete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');
        return redirect('deal');
    }
}
