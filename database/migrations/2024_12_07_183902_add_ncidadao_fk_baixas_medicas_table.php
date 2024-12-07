<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('baixas_medicas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ncidadao');
            $table->foreign('id_ncidadao')->references('n_cidadao')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baixas_medicas', function (Blueprint $table) {
            $table->dropForeign(['id_ncidadao']);
            $table->dropColumn('id_ncidadao');
        });
    }
};
