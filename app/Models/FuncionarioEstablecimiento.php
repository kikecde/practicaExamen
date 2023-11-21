<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Establecimiento;
use App\Models\FuncionarioCargo;
use App\Models\FuncionarioVinculo;
use App\Models\Area;

class FuncionarioEstablecimiento  extends Model
{
    use HasFactory;

    protected $table = 'funcionario_establecimiento';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'idFuncEst';
     protected $fillable = [

      'idFuncEst',
      'funcID',
      'estID',
      'funcVincID',
      'areaID',
      'servID',
      'deptoID',
      'deptoNoMedID',
      'sectorID',
      'horasAsignadas',
      'fechaAlta',
      'fechaBaja',
      'status',
      'created_at',
      'updated_at'
    ];


    public $timestamps = true;

    // Relación con Funcionario
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcID', 'idFunc');
    }

    // Relación con FuncionarioVinculo
    public function vinculo()
    {
        return $this->belongsTo(FuncionarioVinculo::class, 'funcVincID', 'idFuncVinc');
    }

    public function establecimiento()
{
    return $this->belongsTo(Establecimiento::class, 'estID', 'idEst');
}


}


