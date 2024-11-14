<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_user')->constrained('users', 'id');
            $table->string('nome', 255);
            $table->string('morada', 255);
            $table->string('n_cidadao', 255);
            $table->date('data_nascimento');
            $table->string('n_nacionalSaude', 255);
        });
    }

    public function down(): void {
        Schema::dropIfExists('pacientes');
    }
};