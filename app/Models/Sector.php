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

class Sector extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Sectores';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NombreSector',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idSector';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];




    /**
     * Define the relationship between sectors and establishments.
     */


     public function establecimientos()
     {
         return $this->belongsToMany(
             Establecimiento::class,
             'establecimiento_area_servicio_departamento_sector',  // Tabla intermedia que relaciona la tabla pivot establecimiento_area_servicio_departamento con la tabla principal Sectores
             'idSector',                                           // Clave local en Sector (PK de tabla principal Sectores)
             'est_Area_Serv_DeptoID'                               // Clave foranea en EstablecimientoAreaServicioDepartamentoSector (PK de tabla intermedia establecimiento_area_servicio_departamento)
         );
     }

     public function departamentos()
     {
         return $this->belongsToMany(
             Departamento::class,
             'establecimiento_area_servicio_departamento_sector',  // Tabla intermedia que relaciona la tabla pivot establecimiento_area_servicio_departamento con la tabla principal Sectores
             'sectorID',                                           // Clave foránea en la tabla intermedia establecimiento_area_servicio_departamento_sector que referencia a PK de tabla principal Sectores
             'est_Area_Serv_DeptoID'                               // Clave foránea en la tabla intermedia establecimiento_area_servicio_departamento_sector que referencia a PK de tabla intermedia establecimiento_area_servicio_departamento
         );
     }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'deptoID');
    }
}
