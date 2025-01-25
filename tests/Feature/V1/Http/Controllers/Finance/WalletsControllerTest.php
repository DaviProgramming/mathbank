<?php

namespace Tests\Feature\V1\Http\Controllers\Finance;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WalletsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected string $url = "api/v1/finance/wallets";

    public function test_store(): void
    {
        $response = $this->actingAsUser()->post("$this->url");

        dd($response->json());

        $response->assertStatus(200);
    }
}
