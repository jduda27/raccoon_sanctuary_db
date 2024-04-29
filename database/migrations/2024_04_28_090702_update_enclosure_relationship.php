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

        Schema::dropIfExists('Address');

        Schema::create('address', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('street_address', length: 100)->unique();
            $table->string('city', length: 60)->unique();
            $table->string('state', length: 30)->unique();
            $table->char('zipcode', length: 5)->unique();
        });

        Schema::dropIfExists('Employee');

        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('first_name', length: 255);
            $table->string('last_name', length: 255);
            $table->string('phone_number', length: 12)->unique();
            $table->string('email', length: 255)->unique();
            $table->integer('address_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });

        Schema::dropIfExists('Enclosure');

        Schema::create('enclosure', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('enclosure_name', length: 255)->unique();
        });

        Schema::dropIfExists('Raccoon');

        Schema::create(
            'raccoon',
            function (Blueprint $table) {
                $table->increments('id')->primary();
                $table->string('raccoon_name', length: 255);
                $table->integer('age')->nullable()->unsigned();
                $table->char('sex', length: 1);
                $table->decimal('length', total: 5, places: 2);
                $table->decimal('weight', total: 6, places: 2);
                $table->integer('enclosure_id')->unsigned()->unique();
            }
        );

        Schema::dropIfExists('Raccoon_Treatment_History');

        Schema::create('raccoon_treatment_history', function (Blueprint $table) {
            $table->dateTime('treatment_time', precision: 0)->primary();
            $table->integer('treatment_id')->unsigned();
            $table->integer('raccoon_id')->unsigned();
        });

        Schema::dropIfExists('Responsibility');

        Schema::create('responsibility', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->integer('enclosure_id')->unsigned();
        });

        Schema::dropIfExists('Role');

        Schema::create('role', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('role_name', length: 120)->unique();
            $table->integer('responsibility_id')->unsigned()->unique();
            $table->integer('treatment_id')->unsigned()->nullable();
        });

        Schema::dropIfExists('Sanctuary');

        Schema::create('sanctuary', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('sanctuary_name', length: 100)->unique();
            $table->integer('address_id')->unsigned()->unique();
        });

        Schema::dropIfExists('Schedule');

        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->integer('shift_id')->unsigned()->unique()->nullable();
            $table->integer('sanctuary_id')->unsigned()->unique()->nullable();
        });

        Schema::dropIfExists('Shift');

        Schema::create('shift', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->dateTime('start_time', precision: 0)->unique();
            $table->dateTime('end_time', precision: 0)->unique();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('schedule_id')->unsigned();
        });

        Schema::dropIfExists('Storage_Room');

        Schema::create('storage_room', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('location_name', length: 255);
            $table->integer('enclosure_id')->unsigned();
        });

        Schema::dropIfExists('Supply');

        Schema::create('supply', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supply_name', length: 255)->unique();
            $table->decimal('price', total: 6, places: 2)->nullable();
            $table->integer('quantity')->unsigned();
            $table->integer('storage_id')->unsigned();
            $table->primary(['id','storage_id']);
        });

        Schema::dropIfExists('Treatment');

        Schema::create('treatment', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('treatment_type', length: 255)->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
        Schema::dropIfExists('employee');
        Schema::dropIfExists('enclosure');
        Schema::dropIfExists('raccoon');
        Schema::dropIfExists('raccoon_treatment_history');
        Schema::dropIfExists('responsibility');
        Schema::dropIfExists('role');
        Schema::dropIfExists('sanctuary');
        Schema::dropIfExists('schedule');
        Schema::dropIfExists('shift');
        Schema::dropIfExists('storage_room');
        Schema::dropIfExists('supply');
        Schema::dropIfExists('treatment');
    }
};
