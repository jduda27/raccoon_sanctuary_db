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
            $table->dropPrimary();
            $table->dropColumn('address_id');
            $table->integer('address_id');
            $table->primary(['street_address','city','state','zipcode']);
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
