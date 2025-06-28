<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clave primaria por defecto
            $table->string('name'); // Nombre completo del usuario
            $table->string('email')->unique(); // Correo electrónico
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // Contraseña

            // Campos personalizados adicionales
            $table->string('dni_usuario')->nullable();
            $table->enum('genero_usuario', ['masculino', 'femenino'])->nullable();
            $table->string('telefono_usuario')->nullable();
            $table->enum('rol_usuario', ['admin', 'user'])->default('user');
            $table->string('cargo')->nullable();

            $table->rememberToken();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
};

