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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->comment('Имя в телеграм.');
            $table->string('telegram_id')->unique()->comment('ИД клиента телеграм.');
            $table->string('login')->unique()->comment('Логин в телеграм.');
            $table->unsignedBigInteger('balance_id')->comment('Ид счета клиента.');
            $table->foreign('balance_id')
                ->references('id')
                ->on('balance_accounts')
                ->nullOnDelete();
            $table->timestamps();
            $table->comment('Пользователи.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
