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
        Schema::create('balance_account_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('balance_id')->comment('Ид счета клиента.');
            $table->foreign('balance_id')
                ->references('id')
                ->on('balance_accounts')
                ->onDelete('cascade');
            $table->unsignedBigInteger('value')->comment('Сумма в копейках.');
            $table->enum('operation_type',['write_on','write_off'])->comment('Тип операции. (write_on/write_off).');
            $table->timestamps();
            $table->comment('История изменения баланса.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_account_histories');
    }
};
