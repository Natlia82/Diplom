<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->integer('typeOfPlace')->default(3);  //вид места вип = 2 или обычное = 1, нет кресла 3
            $table->integer('row')->nullable($value = true); //ряд
            $table->integer('colum')->nullable($value = true); //колонка
            $table->integer('unicum')->unique(); //колонка
            $table->integer('seatNumber')->nullable($value = true);;  //номер места
           // $table->integer('cinemas_id')->unsigned();  //связь с кинозалом
            $table->foreignId('cinema_id')->references('id')->on('cinemas')->cascadeOnDelete();
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
        Schema::dropIfExists('places');
    }
}
