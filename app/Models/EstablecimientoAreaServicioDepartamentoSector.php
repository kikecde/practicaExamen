<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\Departamento;
use App\Models\Sector;
use App\Models\EstablecimientoAreaServicio;
use App\Models\EstablecimientoAreaServicioDepartamento;
use App\Models\EstablecimientoAreaServicioDepartamentoSector;

class EstablecimientoAreaServicioDepartamentoSector extends Pivot
{
    protected $table = 'establecimiento_area_servicio_departamento_sector';
    protected $primaryKey =  'idEst_Area_Serv_Depto_Sector';

    public $timestamps = false;

    protected $fillable = [
        'est_Area_Serv_DeptoID',
        'sectorID'
    ];
}
