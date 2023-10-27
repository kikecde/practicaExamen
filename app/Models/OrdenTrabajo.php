<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Distrito;
use App\Models\OrdenTrabajo;
use App\Models\Movil;
use App\Models\PSX;
use App\Models\Establecimiento;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'OrdenesDeTrabajo';

    protected $fillable = [
      'fechaOT',
      'ordinarioExtraordinario',
      'movilID',
      'chapaMovil',
      'condOT',
      'cond1OT',
      'cond2OT',
      'cond3OT',
      'cond4OT',
      'cond5OT',
      'otOrigenID',
      'desdeOT',
      'hastaOT',
      'kmSalidaOT',
      'kmLlegadaOT',
      'kmEstimadoOT',
      'distanciaKmsID',
      'kmTotalOT',
      'consumoOT',
      'trabajoOT',
      'trabajo1OT',
      'trabajo2OT',
      'trabajo3OT',
      'trabajo4OT',
      'trabajo5OT',
      'trabajo6OT',
      'trabajo7OT',
      'trabajo8OT',
      'trabajo9OT',
      'trabajo10OT',
      'otDistritoID',
      'coberturaDistritoID',
      'emisorOT',
      'created_at',
      'updated_at',
      'observacionInterna',
      'fechaImpreso',
      'fechaEnviado',
      'fechaFinalizado',
    ];

    protected $primaryKey =  'idOT' ;



    /**
     * Obtener el id al que pertenece este conductor.
     *
     * @return BelongsTo
     */
    public function conductor1(): BelongsTo
    {
        return $this->belongsTo(PSX::class, 'condOT1', 'idPSX');
    }

    public function conductor2(): BelongsTo
    {
        return $this->belongsTo(PSX::class, 'condOT2', 'idPSX');
    }
    public function conductor3(): BelongsTo
    {
        return $this->belongsTo(PSX::class, 'condOT3', 'idPSX');
    }
    public function conductor4(): BelongsTo
    {
        return $this->belongsTo(PSX::class, 'condOT4', 'idPSX');
    }
    public function conductor5(): BelongsTo
    {
        return $this->belongsTo(PSX::class, 'condOT5', 'idPSX');
    }


    public function idMoviles()
    {
        return $this->hasOne(Movil::class,  'idMovil', 'movilID');
    }

    public function conductores()
    {
        return $this->hasMany(PSX::class, 'idPSX', 'condOT');
    }

    // public function funciones()
    // {
    //     return $this->belongsTo(FuncionSEME::class, 'idFuncionPSX', 'idFuncion');
    // }

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'trabajo1OT', 'idEst');
    }


}
