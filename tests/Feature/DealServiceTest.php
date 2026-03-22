<?php

use App\Models\Deal;
use App\Models\Journey;
use App\Models\Stage;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Company;
use App\Services\DealService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('assigns the first stage when a deal is created', function () {
    $journey = Journey::factory()->create();
    $stage   = Stage::factory()->create(['journey_id' => $journey->id]);
    $user    = User::factory()->create();
    $company = Company::factory()->create();
    $client  = Client::factory()->create(['company_id' => $company->id]);
    $product = Product::factory()->create();
    $service = new DealService();
    $deal    = $service->create([
        'title'         => 'Test Deal',
        'description'   => 'Test',
        'user_id'       => $user->id,
        'users_in'      => [$user->id],
        'journey_id'    => $journey->id,
        'expected_time' => now()->addDays(30),
        'start'         => now(),
        'client_id'     => $client->id,
        'product_id'    => $product->id,
        'quantity'      => 1,
        'tax'           => 0,
        'total'         => 100,
    ]);

    expect($deal->stage_id)->toBe($stage->id);
});
