<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'tipo_muestra_id',
        'fecha_recoleccion',
        'estado_id',
        'observaciones',
        'paciente_id',
        'tecnico_id'
    ];

    public function tipoMuestra()
    {
        return $this->belongsTo(TipoMuestra::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class);
    }
}

