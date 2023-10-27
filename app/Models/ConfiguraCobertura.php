<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguraCobertura extends Model
{
    use HasFactory;
    protected $table = 'configuracion_cobertura';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_distrito',
        'id_region',
        'distancia_clasificacion',
    ];

    // Relación con el modelo Distrito
    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'id_distrito', 'idDistrito');
    }

    // Relación con el modelo Región
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'idRegion');
    }

    // Dentro del modelo ConfiguraCobertura
    public function cobertura()
    {
        return $this->belongsTo(Cobertura::class, 'id_cobertura', 'distancia_clasificacion');
    }

}

