<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('cognoms');
            $table->string('empresa')->nullable(); // Nom de l'empresa (opcional)
            $table->enum('tipus_client', ['Empresa', 'Particular'])->default('Particular');
            $table->string('adreça')->nullable();
            $table->string('telefon')->nullable();
            $table->string('correu_electronic')->unique();
            $table->string('nif')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('clients');
    }
};