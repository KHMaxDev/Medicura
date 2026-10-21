<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 160);
            $table->text('descripcion')->nullable();
            $table->string('tipo', 100);
            $table->json('efectos_secundarios')->nullable();
            $table->json('interacciones')->nullable();
            $table->timestamps();

            $table->index('nombre');
            $table->index('tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
