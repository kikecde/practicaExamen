<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Establecimiento;
use App\Models\FuncionSEME;

class PersonalSX extends Model
{
    use HasFactory;
    protected $table = 'rrhh_seme_xrs';

    protected $fillable = [
        'nYaPSX',
        'ciPSX',
        'sexoPSX',
        'fnacPSX',
        'profPSX',
        'correoPSX',
        'telPSX',
        'domicilioPSX',
        'idBaseOpPSX',
        'regCondTipoPSX',
        'regCondNroPSX',
        'bloodPSX',
        'seguroPSX',
        'appPSX',
        'contactoUrgPSX',
        'contactoUrgTelPSX',
        'idFuncionPSX',
        'photo_pathPSX',
        'DATE_CREATED',
        'DATE_UPDATED',
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

    public function baseOperativa()
    {
        return $this->belongsTo(Establecimiento::class, 'idBaseOpPSX', 'idEst');
    }

    public function funciones()
    {
        return $this->belongsTo(FuncionSEME::class, 'idFuncionPSX', 'idFuncion');
    }

//     public function especialidades()
//     {
//         return $this->belongsTo(Especialidad::class, 'funcEspecialidad', 'idEspecialidadMED');
//     }

//     public function vinculos()
// {
//     return $this->hasMany(FuncionarioVinculo::class, 'FuncsID');
// }


}
