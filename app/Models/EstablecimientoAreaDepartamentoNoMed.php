<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\DepartamentoNoMed;
use App\Models\EstablecimientoAreaDepartamentoNoMed;


class EstablecimientoAreaDepartamentoNoMed extends Pivot
{
    protected $table = 'establecimiento_area_departamentoNoMed';
    protected $primaryKey =  'idEst_Area_DeptoNoMed';

    public $timestamps = false;

    protected $fillable = [
        'est_AreaID',
        'deptoNoMedID'
    ];
}
