<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\VinculoInstitucion;
use App\Models\VinculoOrden;
use App\Models\VinculoTipoMSPBS;
use App\Models\Funcionario;
use App\Models\FuncionarioEstablecimiento;

class FuncionarioVinculo extends Model
{
    use HasFactory;
    protected $table = 'Funcionario_Vinculos';
    protected $primaryKey = 'idFuncVinc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'funcID',
        'OrdenVinculo',
        'InstitVinc',
        'VincTipoMSPBS',
        'HorasVinc',
        'funcVincEstID',
        'fechaAltaFuncVinc',
        'fechaBajaFuncVinc',
        'vinculoStatus',
        'funcCI',
        'created_at',
        'updated_at',
    ];


    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcID', 'idFunc');
    }

    // Relación con FuncionarioEstablecimiento
    public function establecimiento()
    {
        return $this->hasOneThrough(
            Establecimiento::class,
            FuncionarioEstablecimiento::class,
            'funcVincID',  // foreign key on FuncionarioEstablecimiento
            'idEst',       // foreign key on Establecimiento
            'idFuncVinc',  // local key on FuncionarioVinculo
            'estID'        // local key on FuncionarioEstablecimiento
        );
    }


    public function institucion()
    {
        return $this->belongsTo(VinculoInstitucion::class, 'InstitVinc');
    }

    public function ordenVinculo()
    {
        return $this->belongsTo(VinculoOrden::class, 'OrdenVinculo');
    }

    public function tipoVinculo()
    {
        return $this->belongsTo(VinculoTipoMSPBS::class, 'VincTipoMSPBS');
    }


}
