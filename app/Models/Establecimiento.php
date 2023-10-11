<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
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
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idEst';

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
     * Define la relación entre los establecimientos y areas.
     */
    public function sectores()
    {
    return $this->belongsToMany(Sector::class, 'establecimiento_sector', 'idEst', 'estID');
    }

    /**
     * Define la relación entre los establecimientos y servicios.
     */
    public function servicios()
    {
    return $this->belongsToMany(Servicio::class, 'establecimiento_servicio', 'idEst', 'estID');
    }

    /**
     * Define la relación entre los establecimientos y estudios.
     */
    public function estudios()
    {
    return $this->belongsToMany(Estudio::class, 'establecimiento_estudio', 'idEst', 'estID');
    }


}
