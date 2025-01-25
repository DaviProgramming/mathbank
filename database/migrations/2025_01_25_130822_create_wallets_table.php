<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wallet_type_id');
            $table->decimal('balance', 15, 2)->default(0);
            $table->string('currency', 10);
            $table->string('status', 40);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('wallet_type_id')->references('id')->on('type_wallets');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
