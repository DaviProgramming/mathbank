<?php

namespace Tests\Feature\V1\Http\Controllers\Finance;

use Tests\TestCase;
use App\Models\V1\Wallet;
use Illuminate\Http\Response;
use Database\Factories\V1\WalletFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WalletsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected string $url = "api/v1/finance/wallets";

    public function test_store(): void
    {
        $wallet = WalletFactory::new()->make()->toArray();

        $response = $this->actingAsUser()->post("$this->url", $wallet);

        $response->assertStatus(Response::HTTP_OK);

        $walletFinded = Wallet::find($response['data']['id']);

        $this->assertModelExists($walletFinded);
    }
}
