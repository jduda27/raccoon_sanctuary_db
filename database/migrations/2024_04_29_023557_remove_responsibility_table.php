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
        Schema::dropIfExists('responsibility');
        Schema::dropIfExists('role');

        Schema::create('role', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('role_name', length: 120);
            $table->integer('enclosure_id')->unsigned();
            $table->integer('treatment_id')->unsigned()->nullable();
            $table->unique(['role_name', 'enclosure_id']);
        });

        Schema::table('role', function (Blueprint $table) {
            $table->foreign('enclosure_id')
            ->references('id')->on('enclosure')->noActionOnDelete()->noActionOnUpdate();
            $table->foreign('treatment_id')
            ->references('id')->on('treatment')->noActionOnDelete()->noActionOnUpdate();
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
