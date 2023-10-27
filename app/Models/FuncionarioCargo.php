<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Establecimiento;

class FuncionarioCargo  extends Model
{
    use HasFactory;

    protected $table = 'Funcionarios_Cargos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'idFuncCargos';
     protected $fillable = [

        'funcID',
        'funcCargoEst',
        'funcCargosID',
        'created_at',
        'updated_at',

    ];

}
