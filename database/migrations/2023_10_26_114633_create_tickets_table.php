<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('qr')->nullable($value = true);
            $table->decimal('price', 9, 3)->nullable($value = true);
            $table->date('datSession')->nullable($value = true);
            $table->integer('nomerB')->nullable($value = true);
            $table->foreignId('session_id')->references('id')->on('sessions')->cascadeOnDelete();
            $table->foreignId('place_id')->references('id')->on('places')->cascadeOnDelete();
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
        Schema::dropIfExists('tickets');
    }
}
