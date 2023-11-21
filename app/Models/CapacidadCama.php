<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Servicio;
use App\Models\Departamento;
use App\Models\MovimientoCama;

class CapacidadCama extends Model
{
    use HasFactory;

    protected $table = 'CapacidadCamasEstablecimientos';
    protected $primaryKey =  'idCapacidadCamas';
    public $timestamps = true;

    protected $fillable = [
        'capacidadIdEst',
        'capacidadIdServ',
        'capacidadEst_Area_Serv_DeptoID',
        'capacidadUnidades',
        'capacidadInternacionTipo',
    ];

    protected $createdAt = 'date_created';
    protected $updatedAt = 'date_updated';

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'capacidadIdEst', 'idEst');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'capacidadIdServ', 'idServ');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'capacidadIdDepto', 'idServ');
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoCama::class, 'establecimientoServicio', 'idCapacidadCamas');
    }



}
