<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Deal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $deal=Deal::withTrashed()->get();
       $lose=Deal::withTrashed()->where('status',0)->count();
       $won=Deal::withTrashed()->where('status',1)->count();
        $ongoing=Deal::count();
        return view('index', compact('deal','lose','won','ongoing'));
    }
}
