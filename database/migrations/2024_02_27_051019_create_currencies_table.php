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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('exchange_start');
            $table->string('exchange_stop');
            $table->dateTime('dt_start');
            $table->dateTime('dt_stop');
            $table->tinyInteger('deleted')->default(0);
            $table->unsignedBigInteger('period_id');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_fw_valuta');
    }
};
