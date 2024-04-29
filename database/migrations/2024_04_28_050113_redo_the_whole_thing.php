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

        Schema::create('Address', function (Blueprint $table) {
            $table->increments('address_id')->primary();
            $table->string('street_address', length: 100)->unique();
            $table->string('city', length: 60)->unique();
            $table->string('state', length: 30)->unique();
            $table->char('zipcode', length: 5)->unique();
        });

        Schema::dropIfExists('Employee');

        Schema::create('Employee', function (Blueprint $table) {
            $table->increments('employee_id')->primary();
            $table->string('first_name', length: 255);
            $table->string('last_name', length: 255);
            $table->string('phone_number', length: 12)->unique();
            $table->string('email', length: 255)->unique();
            $table->integer('address_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });

        Schema::dropIfExists('Enclosure');

        Schema::create('Enclosure', function (Blueprint $table) {
            $table->increments('enclosure_id')->primary();
            $table->string('enclosure_name', length: 255)->unique();
            $table->integer('storage_id')->unsigned()->nullable();
        });

        Schema::dropIfExists('Raccoon');

        Schema::create('Raccoon', function (Blueprint $table) {
                $table->increments('raccoon_id')->primary();
                $table->string('raccoon_name', length: 255);
                $table->integer('age')->nullable()->unsigned();
                $table->char('sex', length: 1);
                $table->decimal('length', total: 5, places: 2);
                $table->decimal('weight', total: 6, places: 2);
                $table->integer('enclosure_id')->unsigned()->unique();
            }
        );

        Schema::dropIfExists('Raccoon_Treatment_History');

        Schema::create('Raccoon_Treatment_History', function (Blueprint $table) {
            $table->dateTime('treatment_time', precision: 0)->primary();
            $table->integer('treatment_id')->unsigned();
            $table->integer('raccoon_id')->unsigned();
        });

        Schema::dropIfExists('Responsibility');

        Schema::create('Responsibility', function (Blueprint $table) {
            $table->increments('responsibility_id')->primary();
            $table->integer('enclosure_id')->unsigned();
        });

        Schema::dropIfExists('Role');

        Schema::create('Role', function (Blueprint $table) {
            $table->increments('role_id')->primary();
            $table->string('role_name', length: 120)->unique();
            $table->integer('responsibility_id')->unsigned()->unique();
            $table->integer('treatment_id')->unsigned()->nullable();
        });

        Schema::dropIfExists('Sanctuary');

        Schema::create('Sanctuary', function (Blueprint $table) {
            $table->increments('sanctuary_id')->primary();
            $table->string('sanctuary_name', length: 100)->unique();
            $table->integer('address_id')->unsigned()->unique();
        });

        Schema::dropIfExists('Schedule');

        Schema::create('Schedule', function (Blueprint $table) {
            $table->increments('schedule_id')->primary();
            $table->integer('shift_id')->unsigned()->unique()->nullable();
            $table->integer('sanctuary_id')->unsigned()->unique();
        });

        Schema::dropIfExists('Shift');

        Schema::create('Shift', function (Blueprint $table) {
            $table->increments('shift_id')->primary();
            $table->dateTime('start_time', precision: 0)->unique();
            $table->dateTime('end_time', precision: 0)->unique();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('schedule_id')->unsigned();
        });

        Schema::dropIfExists('Storage_Room');

        Schema::create('Storage_Room', function (Blueprint $table) {
            $table->increments('storage_id')->primary();
            $table->string('location_name', length: 255);
            $table->integer('supply_id')->unsigned();
        });

        Schema::dropIfExists('Supply');

        Schema::create('Supply', function (Blueprint $table) {
            $table->increments('supply_id')->primary();
            $table->string('supply_name', length: 255)->unique();
            $table->decimal('price', total: 6, places: 2)->nullable();
            $table->integer('quantity')->unsigned();
        });

        Schema::dropIfExists('Treatment');

        Schema::create('Treatment', function (Blueprint $table) {
            $table->increments('treatment_id')->primary();
            $table->string('treatment_type', length: 255)->unique();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Address');
        Schema::dropIfExists('Employee');
        Schema::dropIfExists('Enclosure');
        Schema::dropIfExists('Raccoon');
        Schema::dropIfExists('Raccoon_Treatment_History');
        Schema::dropIfExists('Responsibility');
        Schema::dropIfExists('Role');
        Schema::dropIfExists('Sanctuary');
        Schema::dropIfExists('Schedule');
        Schema::dropIfExists('Shift');
        Schema::dropIfExists('Storage_Room');
        Schema::dropIfExists('Supply');
        Schema::dropIfExists('Treatment');
    }
};
