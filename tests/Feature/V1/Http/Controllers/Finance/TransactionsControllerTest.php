<?php

namespace Tests\Feature\V1\Http\Controllers\Finance;

use Tests\TestCase;
use App\Models\V1\Wallet;
use Illuminate\Http\Response;
use App\Models\V1\Transaction;
use Illuminate\Support\Carbon;
use Database\Factories\V1\UserFactory;
use Database\Factories\V1\WalletFactory;
use Database\Factories\V1\TransactionFactory;
use App\Enums\Transaction\TransactionTypeEnum;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TransactionsControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected string $url = 'api/v1/finance/transactions';

    public function test_all_by_user(): void
    {
        $user = UserFactory::new()->create();

        $wallet = WalletFactory::new()
            ->stateUser($user)
            ->create();

        TransactionFactory::new()
            ->count(5)
            ->stateWallet($wallet)
            ->create();

        $response = $this->actingAsUser($user)->getJson("$this->url/all");

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'wallet_id',
                    'wallet_id_transfer',
                    'amount',
                    'type',
                    'recorded_at',
                ]
            ]
        ]);

        $response->assertJsonCount(5, 'data');
    }

    public function test_all_by_user_with_filter(): void
    {
        $user = UserFactory::new()->create();

        $wallet = WalletFactory::new()
            ->stateUser($user)
            ->create();

        TransactionFactory::new()
            ->count(5)
            ->stateWallet($wallet)
            ->stateCreatedAt(Carbon::now()->subDays(5))
            ->create();

        TransactionFactory::new()
            ->count(5)
            ->stateWallet($wallet)
            ->create();

        $date = Carbon::now();

        $dataInicial = $date->format('Y-m-d');

        $response = $this->actingAsUser($user)->getJson("$this->url/all?data_inicial=$dataInicial");

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'wallet_id',
                    'wallet_id_transfer',
                    'amount',
                    'type',
                    'recorded_at',
                ]
            ]
        ]);

        $response->assertJsonCount(5, 'data');
    }

    public function test_all_by_wallet(): void
    {
        $user = UserFactory::new()->create();

        $wallet = WalletFactory::new()
            ->stateUser($user)
            ->create();

        TransactionFactory::new()
            ->count(5)
            ->stateWallet($wallet)
            ->create();

        $response = $this->actingAsUser($user)->getJson("$this->url/wallet/$wallet->id");

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'wallet_id',
                    'wallet_id_transfer',
                    'amount',
                    'type',
                    'recorded_at',
                ]
            ]
        ]);

        $response->assertJsonCount(5, 'data');
    }

    public function test_all_by_wallet_with_filter(): void
    {
        $user = UserFactory::new()->create();

        $wallet = WalletFactory::new()
            ->stateUser($user)
            ->create();

        TransactionFactory::new()
            ->count(5)
            ->stateWallet($wallet)
            ->stateCreatedAt(Carbon::now()->subDays(5))
            ->create();

        TransactionFactory::new()
            ->count(5)
            ->stateWallet($wallet)
            ->create();

        $date = Carbon::now();

        $dataInicial = $date->format('Y-m-d');

        $response = $this->actingAsUser($user)->getJson("$this->url/wallet/$wallet->id?data_inicial=$dataInicial");

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'wallet_id',
                    'wallet_id_transfer',
                    'amount',
                    'type',
                    'recorded_at',
                ]
            ]
        ]);

        $response->assertJsonCount(5, 'data');
    }

    public function test_store(): void
    {
        $initialAmount = 200;

        $walletOrigin = WalletFactory::new()
            ->stateBalance($initialAmount)
            ->create();

        $walletDestination = WalletFactory::new()
            ->stateBalance(0)
            ->create();

        $transaction = TransactionFactory::new()
            ->stateWallet($walletOrigin)
            ->stateWalletTransfer($walletDestination)
            ->stateType(TransactionTypeEnum::SENT)
            ->stateAmount(100)
            ->make()
            ->toArray();

        $response = $this->actingAsUser()->postJson($this->url, $transaction);

        $response->assertStatus(Response::HTTP_OK);

        $walletOriginFinded = Wallet::find($response->json('data.wallet_id'));

        $walletDestinationFinded = Wallet::find($response->json('data.wallet_id_transfer'));

        $this->assertModelExists($walletOriginFinded);
        $this->assertModelExists($walletDestinationFinded);

        $this->assertEquals($initialAmount - $transaction['amount'], $walletOriginFinded->balance);
        $this->assertEquals($transaction['amount'], $walletDestinationFinded->balance);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'wallet_id',
                'wallet_id_transfer',
                'amount',
                'type',
                'recorded_at',
            ]
        ]);
    }

    public function test_deposit(): void
    {
        $wallet = WalletFactory::new()
            ->stateBalance(0)
            ->create();

        $transaction = TransactionFactory::new()
            ->stateWallet($wallet)
            ->stateWalletTransfer($wallet)
            ->stateType(TransactionTypeEnum::DEPOSIT)
            ->stateAmount(100)
            ->make()
            ->toArray();

        $response = $this->actingAsUser()->postJson("$this->url/deposit", $transaction);

        $response->assertStatus(Response::HTTP_OK);

        $walletFinded = Wallet::find($response->json('data.wallet_id'));

        $this->assertModelExists($walletFinded);

        $this->assertEquals($transaction['amount'], $walletFinded->balance);

        $transactionFinded = Transaction::find($response->json('data.id'));

        $this->assertModelExists($transactionFinded);

        $this->assertEquals($transaction['amount'], $transactionFinded->amount);

        $this->assertEquals($transaction['wallet_id'], $transactionFinded->wallet_id);

        $this->assertEquals($transaction['wallet_id_transfer'], $transactionFinded->wallet_id_transfer);

        $this->assertEquals($transaction['type'], $transactionFinded->type);
    }

    public function test_withdraw(): void
    {
        $wallet = WalletFactory::new()
            ->stateBalance(100)
            ->create();

        $transaction = TransactionFactory::new()
            ->stateWallet($wallet)
            ->stateWalletTransfer($wallet)
            ->stateAmount(100)
            ->stateType(TransactionTypeEnum::WITHDRAW)
            ->make()
            ->toArray();

        $response = $this->actingAsUser()->postJson("$this->url/withdraw", $transaction);

        $response->assertStatus(Response::HTTP_OK);

        $walletFinded = Wallet::find($response->json('data.wallet_id'));

        $this->assertModelExists($walletFinded);

        $this->assertEquals($wallet->balance - $transaction['amount'], $walletFinded->balance);

        $transactionFinded = Transaction::find($response->json('data.id'));

        $this->assertModelExists($transactionFinded);

        $this->assertEquals($transaction['amount'], $transactionFinded->amount);

        $this->assertEquals($transaction['wallet_id'], $transactionFinded->wallet_id);

        $this->assertEquals($transaction['wallet_id_transfer'], $transactionFinded->wallet_id_transfer);

        $this->assertEquals($transaction['type'], $transactionFinded->type);
    }

    public function test_update(): void
    {
        $initialAmount = 200;

        $walletOrigin = WalletFactory::new()
            ->stateBalance($initialAmount)
            ->create();

        $walletDestination = WalletFactory::new()
            ->stateBalance(0)
            ->create();

        $transaction = TransactionFactory::new()
            ->stateWallet($walletOrigin)
            ->stateWalletTransfer($walletDestination)
            ->stateAmount(200)
            ->create();

        $transactionWillUpdate = TransactionFactory::new()
            ->stateWallet($walletOrigin)
            ->stateWalletTransfer($walletDestination)
            ->stateAmount(150)
            ->make()
            ->toArray();

        $response = $this->actingAsUser()->putJson("$this->url/$transaction->id", $transactionWillUpdate);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'wallet_id',
                'wallet_id_transfer',
                'amount',
                'type',
                'recorded_at',
            ]
        ]);

        $transactionFinded = Transaction::find($transaction->id);

        $this->assertEquals($transactionWillUpdate['amount'], $transactionFinded->amount);

        $this->assertEquals($transactionWillUpdate['wallet_id'], $transactionFinded->wallet_id);

        $this->assertEquals($transactionWillUpdate['wallet_id_transfer'], $transactionFinded->wallet_id_transfer);

        $this->assertEquals($transactionWillUpdate['type'], $transactionFinded->type);
    }

    public function test_destroy(): void
    {
        $transaction = TransactionFactory::new()
            ->stateAmount(200)
            ->create();

        $response = $this->actingAsUser()->deleteJson("$this->url/$transaction->id");

        $response->assertStatus(Response::HTTP_OK);

        $this->assertModelMissing($transaction);

        $response->assertJsonStructure([
            'message',
            'data'
        ]);
    }
}
