<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\Departamento;
use App\Models\Sector;

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

    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'areaID');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicioID');
    }

    public function sectores()
    {
        return $this->hasMany(Sector::class, 'departamentoID');
    }

}
