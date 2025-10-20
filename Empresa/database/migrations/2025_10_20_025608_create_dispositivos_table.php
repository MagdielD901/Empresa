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
       Schema::create('dispositivos', function (Blueprint $table) {
    $table->id();
    $table->string('tipo'); // Tablet o Teléfono
    $table->string('marca');
    $table->string('modelo');
    $table->string('numero_serie')->unique();
    $table->string('estado')->default('Disponible'); // Disponible, Asignado, Dañado, etc.
    $table->unsignedBigInteger('usuario_id')->nullable(); // Relación con usuario
    $table->timestamps();

    $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
