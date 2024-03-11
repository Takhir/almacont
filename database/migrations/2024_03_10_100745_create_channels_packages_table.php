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
        Schema::create('channels_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_id');
            //$table->foreign('channel_id')->references('id')->on('channels');
            $table->unsignedBigInteger('package_id');
            //$table->foreign('package_id')->references('id')->on('packages');
            $table->unsignedBigInteger('department_id');
            //$table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('town_id');
            //$table->foreign('town_id')->references('id')->on('departments');
            $table->timestamp('dt_start')->nullable();
            $table->timestamp('dt_stop')->nullable();
            $table->tinyInteger('presence');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels_packages');
    }
};
