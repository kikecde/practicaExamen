<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Servicio;
use App\Models\CapacidadCama;

class MovimientoCama extends Model
{
    use HasFactory;

    protected $table = 'movimientoCamas';
    protected $primaryKey =  'idMovimientoCamas';

    protected $fillable = [
        'establecimientoServicio',
        'camasOcupadas',
        'altasUltimas24Horas',
        'posiblesAltas6Horas',
        'posiblesAltas12Horas',
        'tipoReporte',
        'fechaRegistro',
    ];

    public function establecimientoServicio()
    {
        return $this->belongsTo(CapacidadCama::class, 'establecimientoServicio', 'idCapacidadCamas');
    }
}
