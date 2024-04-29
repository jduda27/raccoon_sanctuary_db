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
        Schema::dropIfExists('raccoon');
        Schema::create(
            'raccoon',
            function (Blueprint $table) {
                $table->increments('id')->primary()->cascadeOnDelete()->cascadeOnUpdate();
                $table->string('raccoon_name', length: 255);
                $table->integer('age')->nullable()->unsigned();
                $table->char('sex', length: 1);
                $table->decimal('length', total: 5, places: 2);
                $table->decimal('weight', total: 6, places: 2);
                $table->integer('enclosure_id')->unsigned()->unique();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
