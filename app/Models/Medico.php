<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nome',
        'morada',
        'n_cidadao',
        'telemovel',
        'especialidade',
    ];

    public function utilizador()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function unidadesMedicas()
    {
        return $this->belongsToMany(UnidadesMedicas::class, 'medicos_unidades_medicas', 'id_medico', 'id_unidadeMedica')
                    ->withPivot('ativo');
    }
}
