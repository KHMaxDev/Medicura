<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->string('apellido_paterno', 120);
            $table->string('apellido_materno', 120)->nullable();
            $table->string('email')->unique();
            $table->string('contrasena');
            $table->string('tipo', 20)->default('paciente');
            $table->string('estatus', 20)->default('pendiente');
            $table->string('celular', 10)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('genero', 20)->nullable();
            $table->string('curp', 18)->nullable()->unique();
            $table->string('cedula', 40)->nullable()->unique();
            $table->string('especialidad', 120)->nullable();
            $table->string('institucion', 160)->nullable();
            $table->string('foto_perfil')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['tipo', 'estatus']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
