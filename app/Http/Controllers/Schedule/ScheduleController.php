<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
public function getEvents(){
    $schedules=Activity::all();
    return response()->json($schedules);
}
}
