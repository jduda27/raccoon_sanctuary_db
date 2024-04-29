<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('employee');

        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('first_name', length: 255);
            $table->string('last_name', length: 255);
            $table->string('phone_number', length: 12)->unique();
            $table->string('email', length: 255)->unique();
            $table->integer('address_id')->unsigned()->unique();
            $table->integer('role_id')->unsigned();
        });

        Schema::table('employee', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('address')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('role_id')->references('id')->on('role')->noActionOnDelete()->noActionOnUpdate();
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
