<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Servicio;
use App\Models\DepartamentoNoMed;

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

    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'areaID');
    }



}
