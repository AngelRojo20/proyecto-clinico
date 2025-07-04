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
        Schema::create('muestras', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('tecnico_id');
            $table->unsignedBigInteger('tipo_muestra_id');
            $table->unsignedBigInteger('estado_id');
            $table->date('fecha_recoleccion');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('tecnico_id')->references('id')->on('tecnicos')->onDelete('cascade');
            $table->foreign('tipo_muestra_id')->references('id')->on('tipo_muestras')->onDelete('restrict');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muestras');
    }
};
