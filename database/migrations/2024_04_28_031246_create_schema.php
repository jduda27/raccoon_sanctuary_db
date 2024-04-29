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

        Schema::dropIfExists('Employee');

        Schema::create('Employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('first_name', length: 255);
            $table->string('last_name', length: 255);
            $table->string('phone_number', length: 12);
            $table->string('email', length: 255);
            $table->primary(['employee_id', 'phone_number', 'email']);
        });

        Schema::dropIfExists('Address');

        Schema::create('Address', function (Blueprint $table) {
            $table->id('address_id');
            $table->string('street_address', length: 100);
            $table->string('city', length: 60);
            $table->string('state', length: 30);
            $table->char('zipcode', length: 5);
            $table->primary(['address_id', 'street_address', 'city', 'state', 'zipcode']);
        });

        Schema::dropIfExists('Role');

        Schema::create('Role', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name', length: 120);
            $table->primary(['role_id', 'role_name']);
        });

        Schema::dropIfExists('Responsibility');

        Schema::create('Responsibility', function (Blueprint $table) {
            $table->integer('responsibility_id')->unsigned();
        });

        Schema::dropIfExists('Enclosure');

        Schema::create('Enclosure', function (Blueprint $table) {
            $table->id('enclosure_id');
            $table->string('enclosure_name', length: 255);
            $table->primary('enclosure_id');
        });

        Schema::dropIfExists('Storage_Room');

        Schema::create('Storage_Room', function (Blueprint $table) {
            $table->integer('storage_id')->unsigned();
            $table->string('location_name', length: 255);
        });

        Schema::dropIfExists('Supply');

        Schema::create('Supply', function (Blueprint $table) {
            $table->id('supply_id');
            $table->string('supply_name', length: 255);
            $table->decimal('price', total: 6, places: 2)->nullable();
            $table->integer('quantity')->unsigned();
        });

        Schema::dropIfExists('Treatment');

        Schema::create('Treatment', function (Blueprint $table) {
            $table->id('treatment_id');
            $table->string('treatment_type', length: 255);
            $table->primary('treatment_id', 'treatment_type');
        });

        Schema::dropIfExists('Sanctuary');

        Schema::create('Sanctuary', function (Blueprint $table) {
            $table->id('sanctuary_id');
            $table->string('sanctuary_name', length: 100);
            $table->primary('sanctuary_id', 'sanctuary_name');
        });

        Schema::dropIfExists('Schedule');

        Schema::create('Schedule', function (Blueprint $table) {
            $table->integer('schedule_id')->unsigned();
        });

        Schema::dropIfExists('Shift');

        Schema::create('Shift', function (Blueprint $table) {
            $table->id('shift_id');
            $table->dateTime('start_time', precision: 0);
            $table->dateTime('end_time', precision: 0);
            $table->primary(['shift_id', 'start_time', 'end_time']);
        });

        Schema::dropIfExists('Raccoon_Treatment_History');

        Schema::create('Raccoon_Treatment_History', function (Blueprint $table) {
            $table->dateTime('treatment_time', precision: 0);
            $table->primary('treatment_time');
        });

        Schema::dropIfExists('Raccoon');

        Schema::create(
            'Raccoon',
            function (Blueprint $table) {
                $table->id('raccoon_id');
                $table->string('raccoon_name', length: 255);
                $table->integer('age')->nullable()->unsigned();
                $table->char('sex', length: 1);
                $table->decimal('length', total: 5, places: 2);
                $table->decimal('weight', total: 6, places: 2);
            }
        );

        //make relationships

        Schema::table('Employee', function (Blueprint $table) {
            $table->dropColumn('address_id');
            $table->integer('address_id')->unsigned()
                  ->references('address_id')->on('Address')->constrained();
            $table->integer('role_id')->unsigned()
                  ->references('role_id')->on('Role')->constraint();
        });

        Schema::table('Enclosure', function (Blueprint $table) {
            $table->integer('storage_id')->unsigned()
                  ->references('storage_id')->on('Storage_Room')->constrained()->nullable();
        });

        Schema::table('Raccoon_Treatment_History', function (Blueprint $table) {
            $table->integer('treatment_id')->unsigned()
                  ->references('treatment_id')->on('Treatment')->constrained();
            $table->integer('raccoon_id')->unsigned()
                  ->references('raccoon_id')->on('Raccoon')->constrained();
        });

        Schema::table('Raccoon', function (Blueprint $table) {
            $table->integer('enclosure_id')->unsigned()
                  ->references('enclosure_id')->on('Enclosure')->constrained();
        });

        Schema::table('Shift', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned()
                  ->references('employee_id')->on('Employee')
                  ->cascadeOnDelete()->cascadeOnUpdate()->nullable()->constrained();
            $table->integer('schedule_id')->unsigned()
                  ->references('schedule_id')->on('Schedule')
                  ->cascadeOnDelete()->cascadeOnUpdate()->constrained();
        });

        Schema::table('Schedule', function (Blueprint $table) {
            $table->integer('shift_id')->unsigned()
                  ->references('shift_id')->on('Shift')->nullable()->constrained();
            $table->integer('sanctuary_id')->unsigned()
                  ->references('sanctuary_id')->on('Sanctuary')->constrained();
            $table->primary(['schedule_id','sanctuary_id']);
        });

        Schema::table('Sanctuary', function (Blueprint $table) {
            $table->integer('address_id')->unsigned()
                  ->references('address_id')->on('Address')
                  ->cascadeOnDelete()->constrained();
        });

        Schema::table('Employee', function (Blueprint $table) {
            $table->integer('address_id')->unsigned()
                  ->references('address_id')->on('Address')
                  ->cascadeOnDelete()->constrained();
        });

        Schema::table('Storage_Room', function (Blueprint $table) {
            $table->integer('supply_id')->unsigned()
                  ->references('supply_id')->on('Supply')->constrained();
            $table->primary(['storage_id','supply_id']);
        });

        Schema::table('Role', function (Blueprint $table) {
            $table->integer('responsibility_id')->unsigned()
                  ->references('responsibility_id')->on('Responsibility')->constrained();
            $table->integer('treatment_id')->unsigned()
                  ->references('treatment_id')->on('Treatment')->nullable()->constrained();
        });

        Schema::table('Responsibility', function (Blueprint $table) {
            $table->integer('enclosure_id')->unsigned()
                  ->references('enclosure_id')->on('Enclosure')->constrained();
            $table->primary(['responsibility_id','enclosure_id']);
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
