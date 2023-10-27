<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\VinculoInstitucion;
use App\Models\VinculoOrden;
use App\Models\VinculoTipoMSPBS;

class FuncionarioVinculo extends Model
{
    use HasFactory;
    protected $table = 'Funcionario_Vinculos';
    protected $primaryKey = 'idFuncsVincs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        
        'FuncsID',
        'OrdenVinculo',
        'InstitVinc',
        'VincTipoMSPBS',
        'HorasVinc',
        'funcVincEstab',
        'fechaAltaVinc',
        'fechaBajaVinc',
        'vinculoStatus',
        'funcCI',
        'created_at',
        'updated_at',       
    ];

   
    
    
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

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'funcVincEstab');
    }
    
}