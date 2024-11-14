<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadesMedicas extends Model
{
    use HasFactory;
    protected $table = 'unidades_medicas';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    
    protected $fillable = [
        'nome', 
        'morada', 
        'setor',
    ];

    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'medicos_unidades_medicas', 'id_unidadeMedica', 'id_medico')
                    ->withPivot('ativo');
    }
}
