<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('wallet_id_transfer');
            $table->decimal('amount', 15, 2);
            $table->string('type', 40);
            $table->timestamps();

            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->foreign('wallet_id_transfer')->references('id')->on('wallets');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
