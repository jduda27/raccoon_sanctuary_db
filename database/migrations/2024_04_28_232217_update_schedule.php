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
        Schema::table('schedule', function (Blueprint $table) {
            $table->integer('sanctuary_id')->unsigned()->unique()->nullable();
            $table->foreign('sanctuary_id')
            ->references('id')->on('sanctuary');
        });
        Schema::table('shift', function (Blueprint $table) {
            $table->foreign('schedule_id')
            ->references('id')->on('schedule')
            ->cascadeOnDelete()->cascadeOnUpdate();
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
