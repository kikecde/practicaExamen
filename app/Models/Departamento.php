<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

class Departamento extends Model
{
    use HasFactory;
    protected $table = 'Departamentos';
    protected $primaryKey =  'idDepto';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'NombreDepto',
        'departamento_padreID'

    ];

    // public function area()
    // {
    //     return $this->belongsTo(Area::class, 'areaID');
    // }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servID');
    }

    // public function establecimientos()
    // {
    //     return $this->belongsToMany(Establecimiento::class, 'establecimiento_area_servicio_departamento', 'deptoID', 'estID');
    // }

    // public function sectores()
    // {
    //     return $this->belongsToMany(Sector::class, 'establecimiento_area_servicio_departamento_sector', 'deptoID', 'sectorID');
    // }
    public function servicios()
    {
        return $this->belongsToMany(
            Servicio::class,
            'establecimiento_area_servicio_departamento',     // Tabla intermedia que relaciona la tabla pivot establecimiento_area_servicio con la tabla principal Departamentos
            'deptoID',                                        // Clave foránea en EstablecimientoAreaServicioDepartamento referenciando a PK de tabla principal Departamentos
            'est_Area_ServID'                                 // Clave foránea en EstablecimientoAreaServicioDepartamento referenciando a PK de tabla intermedia establecimiento_area_servicio
        );
    }


    public function sectores()
    {

      return $this->belongsToMany(
        Sector::class,
        EstablecimientoAreaServicioDepartamentoSector::class, // Modelo de Tabla pivot que relaciona la tabla pivot establecimiento_area_servicio_departamento con la tabla principal Sectores

        'est_Area_Serv_DeptoID',  // Clave foránea en EstablecimientoAreaServicioDepartamentoSector referenciando a EstablecimientoAreaServicioDepartamento
        'sectorID',               // Clave foránea en EstablecimientoAreaServicioDepartamentoSector referenciando a Sector
        'idDepto'                // Clave local en Departamento (PK de la tabla Departamentos)

      );
    }


}
