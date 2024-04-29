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
        //make relationships

        Schema::table('employee', function (Blueprint $table) {
            $table->foreign('address_id')
                ->references('id')->on('address')
                ->cascadeOnDelete();
            $table->foreign('role_id')
                ->references('id')->on('role')
                ->noActionOnDelete();
        });

        Schema::table('raccoon', function (Blueprint $table) {
            $table->foreign('enclosure_id')
                ->references('id')->on('enclosure')->unique();
        });

        Schema::table('raccoon_treatment_history', function (Blueprint $table) {
            $table->foreign('treatment_id')
                ->references('id')->on('treatment');
            $table->foreign('raccoon_id')
                ->references('id')->on('raccoon');
        });

        Schema::table('responsibility', function (Blueprint $table) {
            $table->foreign('enclosure_id')
                ->references('id')->on('enclosure');
        });

        Schema::table('role', function (Blueprint $table) {
            $table->foreign('responsibility_id')
                ->references('id')->on('responsibility')->noActionOnUpdate()->noActionOnDelete();
            $table->foreign('treatment_id')
                ->references('id')->on('treatment');
        });

        Schema::table('sanctuary', function (Blueprint $table) {
            $table->foreign('address_id')
                ->references('id')->on('address')
                ->cascadeOnDelete();
        });

        Schema::table('schedule', function (Blueprint $table) {
            $table->foreign('shift_id')
                ->references('id')->on('shift');
            $table->foreign('sanctuary_id')
                ->references('id')->on('sanctuary');
        });

        Schema::table('shift', function (Blueprint $table) {
            $table->foreign('employee_id')
                ->references('id')->on('employee')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('schedule_id')
                ->references('id')->on('schedule')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('supply', function (Blueprint $table) {
            $table->foreign('storage_id')
                  ->references('id')->on('storage_room');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->dropForeign('address_id');
            $table->dropForeign('role_id');
        });

        Schema::table('enclosure', function (Blueprint $table) {
            $table->dropForeign('storage_id');
        });

        Schema::table('raccoon', function (Blueprint $table) {
            $table->dropForeign('enclosure_id');
        });

        Schema::table('raccoon_treatment_history', function (Blueprint $table) {
            $table->dropForeign('treatment_id');
            $table->dropForeign('raccoon_id');
        });

        Schema::table('responsibility', function (Blueprint $table) {
            $table->dropForeign('enclosure_id');
        });

        Schema::table('role', function (Blueprint $table) {
            $table->dropForeign('responsibility_id');
            $table->dropForeign('treatment_id');
        });

        Schema::table('sanctuary', function (Blueprint $table) {
            $table->dropForeign('address_id');
        });

        Schema::table('schedule', function (Blueprint $table) {
            $table->dropForeign('shift_id');
            $table->dropForeign('sanctuary_id');
        });

        Schema::table('shift', function (Blueprint $table) {
            $table->dropForeign('employee_id');
            $table->dropForeign('schedule_id');
        });

        Schema::table('storage_Room', function (Blueprint $table) {
            $table->dropForeign('supply_id');
        });
    }
};
