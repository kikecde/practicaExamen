<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Especialidad;
use App\Models\Distrito;
use App\Models\ProfFuncion;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcNombres',
        'funcApellidos',
        'funcCI',
        'funcFecha_nacimiento',
        'funcSexo',
        'funcEmail',
        'funcTelefono',
        'funcDomicilioDistrito',
        'funcProfesion_funcion',
        'funcEspecialidad',
        'funcSub_Especialidad',
        'funcRegProf',
        'profile_photo_path',
        'updated_at',
        'created_at',
        'IdUser'
    ];

    
        protected $primaryKey =  'IdFunc' ;

    

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

    public function profesiones()
    {
        return $this->belongsTo(ProfFuncion::class, 'funcProfesion_funcion', 'idProfFunc');
    }

    public function especialidades()
    {
        return $this->belongsTo(Especialidad::class, 'funcEspecialidad', 'idEspecialidadMED');
    }

    public function vinculos()
{
    return $this->hasMany(FuncionarioVinculo::class, 'FuncsID');
}


}