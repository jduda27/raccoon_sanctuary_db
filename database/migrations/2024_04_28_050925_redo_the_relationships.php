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

        Schema::table('Employee', function (Blueprint $table) {
            $table->foreign('address_id')
            ->references('address_id')->on('Address')
            ->cascadeOnDelete();
            $table->foreign('role_id')
            ->references('role_id')->on('Role')
            ->noActionOnDelete();
        });

        Schema::table('Enclosure', function (Blueprint $table) {
            $table->foreign('storage_id')
                ->references('storage_id')->on('Storage_Room');
        });

        Schema::table('Raccoon', function (Blueprint $table) {
            $table->foreign('enclosure_id')
            ->references('enclosure_id')->on('Enclosure')->unique();
        });

        Schema::table('Raccoon_Treatment_History', function (Blueprint $table) {
            $table->foreign('treatment_id')
            ->references('treatment_id')->on('Treatment');
            $table->foreign('raccoon_id')
            ->references('raccoon_id')->on('Raccoon');
        });

        Schema::table('Responsibility', function (Blueprint $table) {
            $table->foreign('enclosure_id')
            ->references('enclosure_id')->on('Enclosure');
        });

        Schema::table('Role', function (Blueprint $table) {
            $table->foreign('responsibility_id')
            ->references('responsibility_id')->on('Responsibility');
            $table->foreign('treatment_id')
            ->references('treatment_id')->on('Treatment');
        });

        Schema::table('Sanctuary', function (Blueprint $table) {
            $table->foreign('address_id')
            ->references('address_id')->on('Address')
                ->cascadeOnDelete();
        });

        Schema::table('Schedule', function (Blueprint $table) {
            $table->foreign('shift_id')
            ->references('shift_id')->on('Shift');
            $table->foreign('sanctuary_id')
            ->references('sanctuary_id')->on('Sanctuary');
        });

        Schema::table('Shift', function (Blueprint $table) {
            $table->foreign('employee_id')
                ->references('employee_id')->on('Employee')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('schedule_id')
                ->references('schedule_id')->on('Schedule')
                ->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::table('Employee', function (Blueprint $table) {
            $table->dropForeign('address_id');
            $table->dropForeign('role_id');
        });

        Schema::table('Enclosure', function (Blueprint $table) {
            $table->dropForeign('storage_id');
        });

        Schema::table('Raccoon', function (Blueprint $table) {
            $table->dropForeign('enclosure_id');
        });

        Schema::table('Raccoon_Treatment_History', function (Blueprint $table) {
            $table->dropForeign('treatment_id');
            $table->dropForeign('raccoon_id');
        });

        Schema::table('Responsibility', function (Blueprint $table) {
            $table->dropForeign('enclosure_id');
        });

        Schema::table('Role', function (Blueprint $table) {
            $table->dropForeign('responsibility_id');
            $table->dropForeign('treatment_id');
        });

        Schema::table('Sanctuary', function (Blueprint $table) {
            $table->dropForeign('address_id');
        });

        Schema::table('Schedule', function (Blueprint $table) {
            $table->dropForeign('shift_id');
            $table->dropForeign('sanctuary_id');
        });

        Schema::table('Shift', function (Blueprint $table) {
            $table->dropForeign('employee_id');
            $table->dropForeign('schedule_id');
        });

        Schema::table('Storage_Room', function (Blueprint $table) {
            $table->dropForeign('supply_id');
        });
    }
};
