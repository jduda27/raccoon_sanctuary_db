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

        //create tables

        Schema::dropIfExists('address');

        Schema::create('address', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('street_address', length: 100);
            $table->string('city', length: 60);
            $table->string('state', length: 30);
            $table->char('zipcode', length: 5);
            $table->unique(['street_address','city','state','zipcode']);
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
