<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {

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
    }
};