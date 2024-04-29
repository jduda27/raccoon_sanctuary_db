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

        Schema::dropIfExists('Enclosure');

        Schema::create('Enclosure', function (Blueprint $table) {
            $table->increments('enclosure_id');
            $table->string('enclosure_name', length: 255)->unique();
            $table->integer('storage_id')->unsigned();
            $table->primary(['enclosure_id','storage_id']);
        });

        Schema::dropIfExists('Storage_Room');

        Schema::create('Storage_Room', function (Blueprint $table) {
            $table->increments('storage_id');
            $table->string('location_name', length: 255);
            $table->integer('supply_id')->unsigned();
            $table->primary(['storage_id', 'supply_id']);
        });

        Schema::dropIfExists('Supply');

        Schema::create('Supply', function (Blueprint $table) {
            $table->increments('supply_id')->primary();
            $table->string('supply_name', length: 255)->unique();
            $table->decimal('price', total: 6, places: 2)->nullable();
            $table->integer('quantity')->unsigned();
        });

        Schema::table('Enclosure', function (Blueprint $table) {
            $table->foreign('storage_id')
                ->references('storage_id')->on('Storage_Room');
        });

        Schema::table('Storage_Room', function (Blueprint $table) {
            $table->foreign('supply_id')
                ->references('supply_id')->on('Supply');
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
