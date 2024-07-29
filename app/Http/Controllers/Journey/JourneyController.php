<?php

namespace App\Http\Controllers\Journey;

use App\Http\Controllers\Controller;
use App\Models\Journey;
use App\Models\Stage;
use Illuminate\Http\Request;

class JourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journey=Journey::with('stages')->get();
        return view('Journey.index',compact('journey'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('journey.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stages' => 'required|array',
            'stages.*.name' => 'required|string|max:255',
        ]);

        $journey = Journey::create(['name' => $validatedData['name']]);

        // Add stages
        $journey->stages()->createMany($validatedData['stages']);

        toastr()
            ->addSuccess('تم اضافة البيانات بنجاح.','اضافة');
        return redirect('journey');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $journey=Journey::findOrFail($id);

        return view('journey.edit',compact('journey'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stages' => 'required|array',
            'stages.*.name' => 'required|string|max:255',
        ]);

        $journey = Journey::findOrFail($id);
        $journey->update(['name' => $validatedData['name']]);

        // Sync stages
        $existingStageIds = $journey->stages->pluck('id')->toArray();
        $newStages = $request->input('stages');
        $newStageIds = array_filter(array_column($newStages, 'id'));

        // Delete stages that were removed
        $stagesToDelete = array_diff($existingStageIds, $newStageIds);
        if (!empty($stagesToDelete)) {
            Stage::destroy($stagesToDelete);
        }

        // Update and create stages
        foreach ($newStages as $stage) {
            if (isset($stage['id'])) {
                $journey->stages()->where('id', $stage['id'])->update(['name' => $stage['name']]);
            } else {
                $journey->stages()->create(['name' => $stage['name']]);
            }
        }
        toastr()
            ->addInfo('تم تعديل البيانات بنجاح.','تحديث');
        return redirect('journey');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $joureny=Journey::findOrFail($id);
        $joureny->delete();
        toastr()
            ->addError('تم حذف البيانات بنجاح.','حذف');
        return redirect('journey');
    }
}
