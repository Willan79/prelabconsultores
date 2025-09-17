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
        Schema::create('empresas', function (Blueprint $table) {

            $table->id(); // ID autoincremental
            $table->string('nombre'); // Nombre de la empresa
            $table->string('nit'); // Número de identificación
            $table->string('razon_social'); // Razón social de la empresa
            $table->integer('num_trabajadores'); // Número de trabajadores
            $table->string('ciudad');
            $table->string('direccion');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps(); // created_at y updated_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};
