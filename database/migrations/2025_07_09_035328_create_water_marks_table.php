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
        Schema::create('water_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attachment_id')->comment("Ид вложения.");
            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachment_files')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('size')->comment("Размер в процентах.");
            $table->boolean('repeatable')->comment("Повторяющийся.");
            $table->integer('x_position')->comment("% По горизонтали.");
            $table->integer('y_position')->comment("% По вертикали.");
            $table->timestamps();
            $table->comment('Водяные знаки.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_marks');
    }
};
