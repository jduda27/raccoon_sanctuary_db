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
        Schema::table('raccoon_treatment_history', function (Blueprint $table) {
            $table->foreign('treatment_id')
            ->references('id')->on('treatment')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('raccoon_id')
            ->references('id')->on('raccoon')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('raccoon', function (Blueprint $table) {
            $table->foreign('enclosure_id')
            ->references('id')->on('enclosure')->unique()->noActionOnDelete()->noActionOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
