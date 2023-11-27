<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->date('datSession')->nullable($value = true);
            $table->timestamp('timBegin', $precision = 0)->nullable($value = true);
            $table->timestamp('timEnd', $precision = 0)->nullable($value = true);
            $table->boolean('sale')->default(false); 
            $table->foreignId('cinema_id')->references('id')->on('cinemas')->cascadeOnDelete();
            $table->foreignId('film_id')->references('id')->on('films')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
