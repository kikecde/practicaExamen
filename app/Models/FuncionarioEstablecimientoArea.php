<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Establecimiento;
use App\Models\FuncionarioCargo;
use App\Models\Area;

class FuncionarioEstablecimientoArea  extends Model
{
    use HasFactory;

    protected $table = 'funcionario_establecimiento_area';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'idFunc_Est_Area';
     protected $fillable = [

        'funcID',
        'areaID',
      	'estID'
    ];

}
