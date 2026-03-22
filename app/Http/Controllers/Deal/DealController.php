<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Journey;
use App\Models\Product;
use App\Models\User;
use App\Services\DealService;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function __construct(private DealService $dealService) {}

    public function index()
    {
        $journeys = Journey::with('stages.deals')->get();
        return view('Deal.index', compact('journeys'));
    }

    public function create()
    {
        $users    = User::all();
        $clients  = Client::all();
        $products = Product::all();
        $journeys = Journey::all();
        return view('Deal.create', compact('users', 'clients', 'products', 'journeys'));
    }

    public function store(DealRequest $request)
    {
        $this->dealService->create($request->validated());
        flash()->success('تم اضافة البيانات بنجاح.', 'اضافة');
        return redirect('deal');
    }

    public function show(Deal $deal)
    {
        $activities = Activity::where('deal_id', $deal->id)->get();
        $users      = User::all();
        return view('deal.show', compact('deal', 'activities', 'users'));
    }

    public function edit(Deal $deal)
    {
        $users    = User::all();
        $clients  = Client::all();
        $products = Product::all();
        $journeys = Journey::all();
        return view('deal.edit', compact('deal', 'users', 'clients', 'products', 'journeys'));
    }

    public function update(DealRequest $request, Deal $deal)
    {
        $this->dealService->update($deal, $request->validated());
        flash()->info('تم تحديث البيانات بنجاح.', 'تحديث');
        return redirect('deal');
    }

    public function updateDealStatus(Request $request, $id)
    {
        $deal = Deal::findOrFail($id);

        if ($request->next) {
            $this->dealService->moveToNextStage($deal);
        } elseif ($request->perv) {
            $this->dealService->moveToPreviousStage($deal);
        }

        flash()->info('تم تحديث البيانات بنجاح.', 'تحديث');
        return redirect('deal');
    }

    public function deal_archive(Request $request, $id)
    {
        $deal = Deal::findOrFail($id);
        $this->dealService->archive($deal, $request->status, $request->why_status);
        flash()->info('تم تعديل البيانات بنجاح.', 'تحديث');
        return redirect('deal');
    }

    public function index_archive()
    {
        $deals = Deal::onlyTrashed()->get();
        return view('deal.archive', compact('deals'));
    }

    public function restore_client(string $id)
    {
        $this->dealService->restore($id);
        flash()->info('تم تعديل البيانات بنجاح.', 'تحديث');
        return redirect('deal');
    }

    public function destroy(Deal $deal)
    {
        $this->dealService->forceDelete($deal);
        flash()->error('تم حذف البيانات بنجاح.', 'حذف');
        return redirect('deal');
    }
}
