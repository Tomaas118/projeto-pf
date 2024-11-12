<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $primaryKey = 'Id_Paciente';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nome',
        'morada',
        'n_cidadao',
        'data_nascimento',
        'n_nacionalSaude',
    ];

    public function utilizador()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
