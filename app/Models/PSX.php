<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Especialidad;
use App\Models\Distrito;
use App\Models\ProfFuncion;

class PSX extends Model
{
    use HasFactory;

    protected $table = 'rrhh_seme_xrs';

    protected $fillable = [
      'ciPSX',
      'nYaPSX',
      'sexoPSX',
      'fnacPSX',
      'profPSX',
      'mailPSX',
      'telPSX',
      'domicilioPSX',
      'baseOpPSX',
      'regCondTipoPSX',
      'regCondNroPSX',
      'bloodPSX',
      'seguroPSX',
      'appPSX',
      'contactoUrgPSX',
      'contactoUrgTelPSX',
      'DATE_CREATED',
      'DATE_UPDATED',
      'idFuncionPSX',
      'foto_pathPSX',
      'IdUser'
    ];


        protected $primaryKey =  'idPSX' ;



    /**
     * Obtener el usuario al que pertenece este funcionario.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'IdUser', 'id');
    }

    public function distritos()
    {
        return $this->belongsTo(Distrito::class, 'funcDomicilioDistrito', 'idDistrito');
    }

    public function funciones()
    {
        return $this->belongsTo(FuncionSEME::class, 'idFuncionPSX', 'idFuncion');
    }

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'baseOpPSX', 'idEst');
    }


}
