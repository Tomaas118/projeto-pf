<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        
        Schema::create('paciente', function (Blueprint $table) {
            $table->id('Id_Paciente');
            $table->foreignId('Id_User')->constrained('utilizadores', 'ID');
            $table->string('Nome', 255);
            $table->string('Morada', 255);
            $table->string('N_Cidadao', 255);
            $table->date('DataNascimento');
            $table->string('N_NacionalSaude', 255);
        });
    }

    public function down(): void {
        Schema::dropIfExists('paciente');
    }
};