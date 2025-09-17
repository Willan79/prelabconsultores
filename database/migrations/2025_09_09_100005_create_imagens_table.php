<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trabajo_id');
            $table->string('ruta'); // aquí se guarda la ruta en storage
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('trabajo_id')->references('id')->on('trabajos')->onDelete('cascade');// Si un trabajo se elimina, sus imágenes también lo hacen
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagens');
    }
};
