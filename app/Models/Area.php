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

class Area extends Model
{
    use HasFactory;
    protected $table = 'Areas';
    protected $primaryKey =  'idArea';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'NombreArea',

    ];

    // public function establecimientos()
    // {
    //     return $this->belongsToMany(Establecimiento::class, 'establecimiento_area', 'areaID', 'estID');
    // }

    // public function servicios()
    // {
    //   return $this->belongsToMany(Servicio::class, 'establecimiento_area_servicio', 'est_AreaID', 'servID');
    // }
    // public function departamentos()
    // {
    //     return $this->hasMany(Departamento::class, 'areaID');
    // }

    // public function departamentosNoMed()
    // {
    //     return $this->hasMany(DepartamentoNoMed::class, 'areaID');
    // }



    public function establecimientos()
    {
        return $this->belongsToMany(Establecimiento::class, 'establecimiento_area', 'areaID', 'estID');
    }

    public function servicios()
    {
        return $this->hasManyThrough(
            Servicio::class,
            EstablecimientoAreaServicio::class, // Modelo de Tabla pivot que relaciona la tabla pivot establecimiento_area con la tabla principal Servicios
            'est_AreaID',  // Clave foránea en EstablecimientoAreaServicio referenciando a EstablecimientoArea
            'idServ',      // Clave foránea en Servicio
            'idArea',      // Clave local en Area (PK de la tabla Areas)
            'servID'       // Clave local en EstablecimientoAreaServicio referenciando a Servicio
          );

    }

    // Solo si la área no es médica
    public function departamentosNoMed()
    {
      return $this->hasManyThrough(
        DepartamentoNoMed::class,
        EstablecimientoAreaDepartamentoNoMed::class,  // Modelo de Tabla pivot que relaciona la tabla pivot establecimiento_area con la tabla principal DepartamentosNoMed
        'est_AreaID',                                 // Clave foránea en EstablecimientoAreaDepartamentoNoMed referenciando a PK de tabla intermedia establecimiento_area
        'idDeptoNoMed',                        // Clave  referenciando a tabla principal DepartamentoNoMed
        'idArea',                                     // Clave local en Area
        'deptoNoMedID'                                // Clave foránea en EstablecimientoAreaDepartamentoNoMed referenciando a DepartamentoNoMed

      );
    }



}
