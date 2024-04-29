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

        Schema::disableForeignKeyConstraints();

        Schema::table('raccoon', function (Blueprint $table) {
            $table->foreign('enclosure_id')
            ->references('id')->on('enclosure')->unique()->noActionOnDelete()->noActionOnUpdate();
        });

        Schema::table('raccoon_treatment_history', function (Blueprint $table) {
            $table->foreign('treatment_id')
            ->references('id')->on('treatment')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('raccoon_id')
            ->references('id')->on('raccoon')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('sanctuary', function (Blueprint $table) {
            $table->foreign('address_id')
            ->references('id')->on('address')
            ->cascadeOnDelete();
        });
        Schema::table('schedule', function (Blueprint $table) {
            $table->foreign('sanctuary_id')
            ->references('id')->on('sanctuary')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::dropIfExists('raccoon');
        Schema::create('raccoon', function (Blueprint $table) {
                $table->increments('id')->primary()->noActionOnDelete()->cascadeOnUpdate();
                $table->string('raccoon_name', length: 255);
                $table->integer('age')->nullable()->unsigned();
                $table->char('sex', length: 1);
                $table->decimal('length', total: 5, places: 2);
                $table->decimal('weight', total: 6, places: 2);
                $table->integer('enclosure_id')->unsigned()->unique();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
