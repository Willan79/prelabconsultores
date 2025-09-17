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
        Schema::create('estandars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id'); // o cambia por user_id, empresa_id, etc.
            $table->string('nombre'); // Nombre del documento
            $table->string('archivo'); // Ruta del archivo PDF
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuarios
            $table->timestamps();

            // Clave foránea (opcional)
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estandars');
    }
};
