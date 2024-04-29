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
        Schema::dropIfExists('role');

        Schema::create('role', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('role_name', length: 120);
            $table->integer('responsibility_id')->unsigned();
            $table->integer('treatment_id')->unsigned()->nullable();
            $table->unique(['role_name','responsibility_id']);
        });

        Schema::table('role', function (Blueprint $table) {
            $table->foreign('responsibility_id')
            ->references('id')->on('responsibility')->noActionOnUpdate()->noActionOnDelete();
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
