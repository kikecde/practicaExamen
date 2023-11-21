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
use App\Models\DepartamentoNoMed;
use App\Models\EstablecimientoAreaServicio;
use App\Models\EstablecimientoAreaServicioDepartamento;
use App\Models\EstablecimientoAreaServicioDepartamentoSector;
use App\Models\EstablecimientoAreaDepartamentoNoMed;

class EstablecimientoArea extends Pivot
{
    protected $table = 'establecimiento_area';
    protected $primaryKey =  'idEst_Area';

    // Si tu tabla no tiene timestamps, puedes desactivarlos
    public $timestamps = false;

    protected $fillable = [
        'estID',
        'areaID'
    ];
}

