<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\DepartamentoNoMed;
use App\Models\EstablecimientoAreaDepartamentoNoMed;

class DepartamentoNoMed extends Model
{
    use HasFactory;
    protected $table = 'DepartamentosNoMed';
    protected $primaryKey =  'idDeptoNoMed';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'NombreDeptoNoMed',
        'departamentoNoMed_padreID'

    ];

    public function area()
  {
      return $this->belongsTo(Area::class, 'areaID');
  }

  public function establecimientos()
    {
        return $this->belongsToMany(
          Establecimiento::class,
          'establecimiento_area_departamentoNoMed',     // Tabla intermedia que relaciona la tabla pivot establecimiento_area con la tabla principal DepartamentosNoMed
          'deptoNoMedID',                               // Clave foránea en EstablecimientoAreaDepartamentoNoMed referenciando a PK de tabla principal DepartamentosNoMed
          'est_AreaID');                                // Clave foránea en EstablecimientoAreaDepartamentoNoMed referenciando a PK de tabla intermedia establecimiento_area
    }

    public function areas()
    {
        return $this->belongsToMany(
        Area::class,
        'establecimiento_area_departamentoNoMed',   // Tabla intermedia relaciona la tabla pivot establecimiento_area con la tabla principal DepartamentosNoMed
        'deptoNoMedID',                             // Clave foránea en EstablecimientoAreaDepartamentoNoMed referenciando a PK de tabla principal DepartamentosNoMed
        'est_AreaID'                                // Clave foránea en EstablecimientoAreaDepartamentoNoMed referenciando a PK de tabla intermedia establecimiento_area
      );
    }


}
