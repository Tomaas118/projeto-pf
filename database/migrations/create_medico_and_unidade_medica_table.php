<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {

        Schema::create('medico', function (Blueprint $table) {
            $table->id('Id_Medico');
            $table->foreignId('Id_User')->constrained('utilizadores', 'ID');
            $table->string('Nome', 255);
            $table->string('Telemovel', 255);
            $table->string('Especialidade', 255);
        });

        Schema::create('unidade_medica', function (Blueprint $table) {
            $table->id('Id_UnidadeMedica');
            $table->string('Nome', 255);
            $table->string('Morada', 255);
            $table->string('Setor', 255);
        });

        Schema::create('medico_unidade_medica', function (Blueprint $table) {
            $table->id('Id');
            $table->foreignId('Id_Medico')->constrained('medico', 'Id_Medico');
            $table->foreignId('Id_UnidadeMedica')->constrained('unidade_medica', 'Id_UnidadeMedica');
            $table->boolean('Ativo');
        });
    }

    public function down(): void {
        Schema::dropIfExists('medico');
        Schema::dropIfExists('unidade_medica');
        Schema::dropIfExists('medico_unidade_medica');
    }
};