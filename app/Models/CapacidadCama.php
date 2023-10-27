<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Servicio;

class CapacidadCama extends Model
{
    use HasFactory;

    protected $table = 'establecimiento_servicio';
    protected $primaryKey =  'idEst_serv';
    public $timestamps = true;

    protected $fillable = [
        'estID',
        'servicioID',
        'capacidadUnidades',
    ];

    protected $createdAt = 'date_created';
    protected $updatedAt = 'date_updated';

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'estID', 'idEst');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicioID', 'idServ');
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoCama::class, 'establecimientoServicio', 'idEst_serv');
    }



}
