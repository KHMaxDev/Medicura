<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 160);
            $table->json('direccion');
            $table->timestamps();

            $table->index('nombre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
