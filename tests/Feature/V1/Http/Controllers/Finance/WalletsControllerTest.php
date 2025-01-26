<?php

namespace Tests\Feature\V1\Http\Controllers\Finance;

use App\Enums\Enums\Wallet\WalletTypeEnum;
use App\Enums\Wallet\CurrencysEnum;
use Tests\TestCase;
use App\Models\V1\Wallet;
use Database\Factories\V1\UserFactory;
use Illuminate\Http\Response;
use Database\Factories\V1\WalletFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WalletsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected string $url = "api/v1/finance/wallets";

    public function test_all_by_users(): void
    {
        $this->user = UserFactory::new()->create();

        WalletFactory::new()->stateUser($this->user)->count(9)->create();

        $response = $this->actingAsUser($this->user)->getJson("$this->url/all");

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            '*' => [
                "id",
                "user_id",
                "wallet_type_id",
                "balance",
                "currency",
                "status",
                "created_at",
                "updated_at",
            ]
        ]);

        $wallets = collect($response->json());

        $this->assertEquals(10, $wallets->count());
    }

    public function test_show(): void
    {
        $this->user = UserFactory::new()->create();

        $wallet = WalletFactory::new()->stateUser($this->user)->create();

        $response = $this->actingAsUser($this->user)->getJson("$this->url/$wallet->id");

        $response->assertStatus(Response::HTTP_OK);

        $this->assertEquals($wallet->toArray(), $response->json());
    }

    public function test_store(): void
    {
        $wallet = WalletFactory::new()->make()->toArray();

        $response = $this->actingAsUser()->postJson("$this->url", $wallet);

        $response->assertStatus(Response::HTTP_OK);

        $walletFinded = Wallet::find($response['data']['id']);

        $this->assertModelExists($walletFinded);

        $userFromTheWallet = $walletFinded->user()->first();

        $this->assertModelExists($userFromTheWallet);
    }

    public function test_update(): void
    {
        $this->user = UserFactory::new()->create();

        $wallet = WalletFactory
            ::new()
            ->stateType(WalletTypeEnum::FOREIGN)
            ->stateCurrency(CurrencysEnum::USD)
            ->make()
            ->toArray();

        $walletToBeUpdated = WalletFactory::new()->stateUser($this->user)->create();

        $response = $this->actingAsUser($this->user)->putJson("$this->url/$walletToBeUpdated->id", $wallet);

        $response->assertStatus(Response::HTTP_OK);

        $walletUpdated = collect($response->json('data'));

        $isCurrencyUSD = $walletUpdated->get('currency') === CurrencysEnum::USD->value;
        $this->assertTrue($isCurrencyUSD);

        $isWalletTypeForeign = $walletUpdated->get('wallet_type_id') === WalletTypeEnum::FOREIGN->value;
        $this->assertTrue($isWalletTypeForeign);
    }

    public function test_destroy(): void
    {
        $this->user = UserFactory::new()->create();

        $walletToBeDestroyed = WalletFactory::new()->stateUser($this->user)->create();

        $response = $this->actingAsUser($this->user)->deleteJson("$this->url/$walletToBeDestroyed->id");

        $response->assertStatus(Response::HTTP_OK);

        $this->assertModelMissing($walletToBeDestroyed);
    }
}
