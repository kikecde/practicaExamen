<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\Departamento;

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

    public function establecimientos()
    {
        return $this->belongsToMany(Establecimiento::class, 'establecimiento_area', 'areaID', 'estID');
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'areaID');
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'areaID');
    }

}
