<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('utilizadores', function (Blueprint $table) {
            $table->id('ID');
            $table->string('UserName', 255);
            $table->string('Password', 255);
            $table->string('Email', 255);
            $table->boolean('Tipo');
            $table->timestamps();
        });

        Schema::create('paciente', function (Blueprint $table) {
            $table->id('Id_Paciente');
            $table->foreignId('Id_User')->constrained('utilizadores', 'ID');
            $table->string('Nome', 255);
            $table->string('Morada', 255);
            $table->string('N_Cidadao', 255);
            $table->date('DataNascimento');
            $table->string('N_NacionalSaude', 255);
        });

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

        Schema::create('baixas_medicas', function (Blueprint $table) {
            $table->id('Id_Baixa');
            $table->foreignId('Id_Medico')->constrained('medico', 'Id_Medico');
            $table->foreignId('Id_Paciente')->constrained('paciente', 'Id_Paciente');
            $table->foreignId('Id_UnidadeMedica')->constrained('unidade_medica', 'Id_UnidadeMedica');
            $table->string('Diagnostico', 255);
            $table->date('DataInicio');
            $table->date('DataFim');
            $table->text('Recomendacoes');
        });
    }

    public function down(): void {
        Schema::dropIfExists('baixas_medicas');
        Schema::dropIfExists('medico_unidade_medica');
        Schema::dropIfExists('unidade_medica');
        Schema::dropIfExists('medico');
        Schema::dropIfExists('paciente');
        Schema::dropIfExists('utilizadores');
    }
};