<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {

        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users', 'id');
            $table->string('nome', 255);
            $table->string('morada',255);
            $table->string('telemovel', 255);
            $table->string('n_cidadao', 255)->unique();
            $table->string('especialidade', 255);
        });

        Schema::create('unidades_medicas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('morada', 255);
            $table->string('setor', 255);
        });

        Schema::create('medicos_unidades_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_medico')->constrained('medicos', 'id');
            $table->foreignId('id_unidadeMedica')->constrained('unidades_medicas', 'id');
            $table->boolean('ativo');
        });
    }

    public function down(): void {
        Schema::dropIfExists('medicos_unidades_medicas');
        Schema::dropIfExists('unidades_medicas');
        Schema::dropIfExists('medicos');
        // Schema::dropIfExists('medico');
        // Schema::dropIfExists('unidade_medica');
        // Schema::dropIfExists('medico_unidade_medica');
    }
};