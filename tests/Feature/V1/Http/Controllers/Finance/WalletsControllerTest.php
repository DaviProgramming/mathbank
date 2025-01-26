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

    public function test_store(): void
    {
        $wallet = WalletFactory::new()->make()->toArray();

        $response = $this->actingAsUser()->post("$this->url", $wallet);

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

        $response = $this->actingAsUser($this->user)->put("$this->url/$walletToBeUpdated->id", $wallet);

        $response->assertStatus(Response::HTTP_OK);

        $walletUpdated = collect($response->json('data'));

        $isCurrencyUSD = $walletUpdated->get('currency') === CurrencysEnum::USD->value;
        $this->assertTrue($isCurrencyUSD);

        $isWalletTypeForeign = $walletUpdated->get('wallet_type_id') === WalletTypeEnum::FOREIGN->value;
        $this->assertTrue($isWalletTypeForeign);
    }
}
