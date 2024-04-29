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

        Schema::table('Address', function (Blueprint $table) {
            $table->integer('address_id', autoIncrement: false, unsigned: true)->unique();
        });

        Schema::table('Employee', function (Blueprint $table) {
            $table->integer('address_id',autoIncrement:false,unsigned:true);
            $table->foreign('address_id')
                ->references('address_id')->on('Address')
                ->cascadeOnDelete();
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
