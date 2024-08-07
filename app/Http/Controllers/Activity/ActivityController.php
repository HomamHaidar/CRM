<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivtiyRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {

        $activity=Activity::with('users','user','client','deal')->get();
        $done=Activity::where('is_done',1)->get();

        $users=User::all();
        $clients=Client::where('islead',1)->get();
        $deals=Deal::where('status',0)->get();

        return view("Activity.index",compact('activity','users','clients','done',"deals"));
    }

    public function create()
    {

        return view('activity.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivtiyRequest $request)
    {
        $validated=$request->validated();

        $activity=Activity::create($validated);

        $activity->users()->attach($request->assigned_to);



        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('activity');
    }

    public function show(Activity $activity)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivtiyRequest $request, Activity $activity)
    {
        $validated=$request->validated();

        $activity->update($validated);

        $activity->users()->sync($request->assigned_to);
        if ($request->deal_id){
            $activity->client_id=null;
            $activity->save();
        }
        if ($request->client_id){
            $activity->deal_id=null;
            $activity->save();
        }
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.','تحديث');
        return redirect('activity/');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {

        $activity->delete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');
        return redirect('activity');
    }
    public function completeactivity(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        if ($activity) {
            $activity->is_done = $request->is_done;
            $activity->save();

            return response()->json(['success' => true]);

        }
        return response()->json(['success' => false], 404);

    }
    public function getTasks()
    {

        $activity=Activity::with('users','user','clients')->get();

        $events = [];
        foreach ($activity as $appointment) {
            $events[] = [
                'title' => $appointment->name . ' ('.$appointment->employee->name.')',
                'start' => $appointment->from_time,
                'end' => $appointment->due_time,
            ];
        }

        return view('index', compact('events'));
    }

}
