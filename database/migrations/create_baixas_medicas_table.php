<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {

        Schema::create('baixas_medicas', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_medico')->constrained('medicos', 'id');
            $table->foreignId('id_paciente')->constrained('paciente', 'id');
            $table->foreignId('id_unidadeMedica')->constrained('unidade_medica', 'id');
            $table->string('diagnostico', 255);
            $table->date('dataInicio');
            $table->date('dataFim');
            $table->text('recomendacoes');
        });
    }

    public function down(): void {
        Schema::dropIfExists('baixas_medicas');
    }
};