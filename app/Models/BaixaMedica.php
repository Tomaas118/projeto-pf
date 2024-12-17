<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaixaMedica extends Model
{
    use HasFactory;

    protected $table = 'baixas_medicas';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_medico',
        'id_paciente',
        'id_unidadeMedica',
        'id_ncidadao',
        'diagnostico',
        'dataInicio',
        'dataFim',
        'recomendacoes',
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico', 'id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id');
    }

    public function unidadeMedica()
    {
        return $this->belongsTo(UnidadesMedicas::class, 'id_unidadeMedica', 'id');
    }
}