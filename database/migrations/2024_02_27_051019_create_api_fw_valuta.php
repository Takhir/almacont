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
        Schema::create('api_fw_valuta', function (Blueprint $table) {
            $table->id();
            $table->string('v_name');
            $table->string('n_exchange_start');
            $table->string('n_exchange_stop');
            $table->dateTime('dt_start');
            $table->dateTime('dt_stop');
            $table->tinyInteger('b_deleted')->default(0);
            $table->unsignedBigInteger('report_period_id');
            $table->foreign('report_period_id')->references('id')->on('api_fw_report_period');
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
