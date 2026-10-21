<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $table->string('nombre_tratamiento', 160);
            $table->text('descripcion');
            $table->unsignedInteger('duracion');
            $table->string('dosis', 255);
            $table->date('fecha_creacion');
            $table->timestamps();

            $table->index(['doctor_id', 'fecha_creacion']);
            $table->index(['patient_id', 'fecha_creacion']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
