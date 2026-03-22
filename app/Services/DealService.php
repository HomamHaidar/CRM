<?php

namespace App\Services;

use App\Models\Deal;
use App\Models\Journey;
use App\Models\Product;
use Illuminate\Support\Arr;

class DealService
{
    public function create(array $data): Deal
    {
        $assignedUsers = Arr::pull($data, 'users_in');
        $deal = Deal::create($data);
        if ($assignedUsers) {
            $deal->users()->attach($assignedUsers);
        }
        $this->assignFirstStage($deal);

        return $deal;
    }

    public function update(Deal $deal, array $data): Deal
    {
        $assignedUsers = Arr::pull($data, 'users_in');
        $deal->update($data);
        if ($assignedUsers) {
            $deal->users()->sync($assignedUsers);
        }
        $this->assignFirstStage($deal);

        return $deal;
    }

    public function moveToNextStage(Deal $deal): void
    {

        $stages = Journey::findOrFail($deal->journey_id)
            ->stages()
            ->orderBy('id')
            ->pluck('id');

        $currentIndex = $stages->search($deal->stage_id);
        if ($currentIndex !== false && $currentIndex < $stages->count() - 1) {
            $deal->stage_id = $stages[$currentIndex + 1];
            $deal->save();
        }
    }

    public function moveToPreviousStage(Deal $deal): void
    {
        $stages = Journey::findOrFail($deal->journey_id)
            ->stages()
            ->orderBy('id')
            ->pluck('id');
        $currentIndex = $stages->search($deal->stage_id);
        if ($currentIndex !== false && $currentIndex > 0) {
            $deal->stage_id = $stages[$currentIndex - 1];
            $deal->save();
        }
    }

    public function archive(Deal $deal, string $status, string $reason): void
    {
        $isWon = $status === 'فوز';
        $deal->update([
            'status' => $isWon ? 1 : 0,
            'reason' => $reason,
            'end'    => now(),
        ]);
        if ($isWon && $deal->product) {
            $product = Product::findOrFail($deal->product->id);
            $product->quantity -= $deal->quantity;
            $product->save();
        }

        $deal->delete();
    }

    public function restore(int $id): void
    {
        Deal::onlyTrashed()->findOrFail($id)->restore();
    }
    public function forceDelete(Deal $deal): void
    {
        $deal->forceDelete();
    }
    private function assignFirstStage(Deal $deal): void
    {
        $firstStage = Journey::findOrFail($deal->journey_id)
            ->stages()
            ->orderBy('id')
            ->first();

        if ($firstStage) {
            $deal->stage_id = $firstStage->id;
            $deal->save();
        }
    }
}
