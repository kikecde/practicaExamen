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

class Servicio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NombreServ',
        'areasID',

    ];
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idServ';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];



    /**
     * Define la relación con Servicio.
     */

     public function establecimientos()
    {
        return $this->belongsToMany(
          Establecimiento::class,
          'establecimiento_area_servicio',      // Tabla intermedia que relaciona la tabla pivot establecimiento_area con la tabla principal Servicios
          'servID',                         // Clave foránea en EstablecimientoAreaServicio referenciando a PK de tabla principal Servicios
          'est_AreaID');                        // Clave foránea en EstablecimientoAreaServicio referenciando a PK de tabla intermedia establecimiento_area
    }

    public function areas()
    {
        return $this->belongsToMany(
        Area::class,
        'establecimiento_area_servicio',  // Tabla intermedia relaciona la tabla pivot establecimiento_area con la tabla principal Servicios
        'servID',                     // Clave foránea en EstablecimientoAreaServicio referenciando a PK de tabla principal Servicios
        'est_AreaID'                      // Clave foránea en EstablecimientoAreaServicio referenciando a PK de tabla intermedia establecimiento_area
      );
    }

    public function departamentos()
    {
        return $this->hasManyThrough(
          Departamento::class,
          EstablecimientoAreaServicioDepartamento::class, // Modelo de Tabla pivot que relaciona la tabla pivot establecimiento_area_servicio con la tabla principal Departamentos
          'est_Area_ServID',  // Clave foránea en EstablecimientoAreaServicioDepartamento referenciando a EstablecimientoAreaServicio
          'idDepto',      // Clave primaria en Departamento (PK de la tabla Departamentos)
          'idServ',      // Clave local en Servicio (PK de la tabla Servicios)
          'deptoID'       // Clave foránea en EstablecimientoAreaServicioDepartamento referenciando a Departamento
      );
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'areaID');
    }

    public function departamento()
    {
        return $this->hasMany(Departamento::class, 'deptoID');
    }



}
