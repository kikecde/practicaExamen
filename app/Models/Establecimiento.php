<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;


use App\Models\Sector;


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
        'estUbicacion',
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
     * Define la relación entre los establecimientos y areas.
     */
    public function areas()
    {
    return $this->belongsToMany(Area::class, 'establecimiento_area', 'idEst', 'idArea');
    }

}
