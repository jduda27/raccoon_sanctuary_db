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
        Schema::create('supply', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('supply_name', length: 255);
            $table->decimal('price', total: 6, places: 2)->nullable();
            $table->integer('quantity')->unsigned();
            $table->integer('storage_id')->unsigned();
            $table->unique(['supply_name','storage_id']);
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
