<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\Departamento;
use App\Models\CapacidadCama;
use App\Models\DepartamentoNoMed;
use App\Models\Distrito;
use App\Models\Region;
use App\Models\Movil;
use App\Models\Sector;
use App\Models\Estudio;


class Establecimiento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NombreEstablecimiento',
        'estTipo',
        'estNivel',
        'estMail',
        'estTelefono',
        'estDistritoID',
        'estRegionID',
        'estUbicacionLatitud',
        'estUbicacionLongitud',
        'estAbrev',
        'estLogoPath',
        'created_at',
        'updated_at',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idEst';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];



    /**
     * Define la relación entre los establecimientos y los distritos.
     */
    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'estDistritoID', 'idDistrito');
    }

    /**
     * Define la relación entre los establecimientos y las regiones.
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'estRegionID', 'idRegion');
    }


    /**
     * Define la relación entre los establecimientos y servicios.
     */
    // public function servicios()
    // {
    //     return $this->belongsToMany(Servicio::class, 'establecimiento_area_servicio', 'estID', 'servID');
    // }

    /**
     * Define la relación entre los establecimientos y estudios.
     */
    public function estudios()
    {
        return $this->belongsToMany(Estudio::class, 'establecimiento_estudio', 'est_Area_ServID', 'estudioID');
    }

    public function vinculos()
    {
        return $this->hasMany(FuncionarioVinculo::class, 'funcVincEstID', 'idEst');
    }





    // // Relación con servicios a través de áreas (solo para el área médica)
    // public function servicios()
    // {
    //     return $this->hasManyThrough(
    //         Servicio::class,
    //         Area::class,
    //         'estID', // FK en 'establecimiento_area' que referencia a 'Establecimiento'
    //         'areaID', // FK en 'establecimiento_area_servicio' que referencia a 'Area'
    //         'idEst', // Local key en 'Establecimiento'
    //         'idArea' // Local key en 'Area'
    //     );
    // }

    // // Relación con departamentos a través de servicios (solo para el área médica)
    // public function departamentos()
    // {
    //     return $this->hasManyThrough(
    //         Departamento::class,
    //         Servicio::class,
    //         'estID', // FK en 'establecimiento_area' que referencia a 'Establecimiento'
    //         'servID', // FK en 'establecimiento_area_servicio' que referencia a 'Servicio'
    //         'idEst', // Local key en 'Establecimiento'
    //         'idServ' // Local key en 'Servicio'
    //     );
    // }

    // // Relación con sectores a través de departamentos (solo para el área médica)
    // public function sectores()
    // {
    //     return $this->hasManyThrough(
    //         Sector::class,
    //         Departamento::class,
    //         'estID', // FK en 'establecimiento_area' que referencia a 'Establecimiento'
    //         'deptoID', // FK en 'establecimiento_area_servicio_departamento' que referencia a 'Departamento'
    //         'idEst', // Local key en 'Establecimiento'
    //         'idDepto' // Local key en 'Departamento'
    //     );
    // }

    // // Relación con departamentos no médicos directamente relacionados con áreas no médicas
    // public function departamentosNoMed()
    // {
    //     return $this->hasManyThrough(
    //         DepartamentoNoMed::class,
    //         Area::class,
    //         'estID', // FK en 'establecimiento_area' que referencia a 'Establecimiento'
    //         'areaID', // FK en 'establecimiento_area_departamentoNoMed' que referencia a 'Area'
    //         'idEst', // Local key en 'Establecimiento'
    //         'idArea' // Local key en 'Area'
    //     );
    // }



    public function areas()
    {
        return $this->belongsToMany(Area::class,
        'establecimiento_area',         // Tabla intemedia que relaciona las tablas principales Establecimientos con Areas
        'estID',                        // Clave foránea en establecimiento_area (PK de tabla principal Establecimientos)
        'areaID'                        // Clave foránea en establecimiento_area (PK de tabla principal Areas)
        );
    }

    // public function areas()
    // {
    //     return $this->hasMany(EstablecimientoArea::class, 'estID');
    // }



    // public function departamentosNoMed()
    // {
    //     return $this->belongsToMany(DepartamentoNoMed::class, 'establecimiento_area_departamentoNoMed', 'estID', 'deptoNoMedID');
    // }







}
