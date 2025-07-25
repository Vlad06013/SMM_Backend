<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balance_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('value')->default(0)->comment('Сумма в копейках.');
            $table->timestamps();
            $table->comment('Баланс клиента.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_accounts');
    }
};
