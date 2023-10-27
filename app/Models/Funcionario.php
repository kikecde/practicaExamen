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
    protected $table = 'Funcionarios';

    protected $fillable = [
        'funcNombres',
        'funcCI',
        'funcFecha_nacimiento',
        'funcSexo',
        'funcEmail',
        'funcTelefono',
        'funcProfesion_funcion',
        'funcEspecialidad',
        'funcSub_Especialidad',
        'funcRegProf',
        'profile_photo_path',
        'updated_at',
        'created_at',
        'idUser'
    ];


        protected $primaryKey =  'idFunc' ;



    /**
     * Obtener el usuario al que pertenece este funcionario.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
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

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'funcionario_establecimiento_area', 'funcID', 'areaID')
            ->withPivot('estID');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'funcionario_servicio_area_establecimiento')->withPivot('establecimiento_id', 'area_id');
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'funcionario_departamento_servicio')->withPivot('servicio_id');
    }

    public function sectores()
    {
        return $this->belongsToMany(Sector::class, 'funcionario_sector_departamento')->withPivot('departamento_id');
    }

    public function departamentoNoMedico()
    {
        return $this->belongsTo(DepartamentoNoMed::class);
    }


    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'Funcionarios_Cargos', 'funcID', 'funcCargosID')
            ->withPivot('funcCargoEst');
    }
    public function establecimientos(): BelongsToMany
    {
        return $this->belongsToMany(Establecimiento::class, 'funcionario_establecimiento_area', 'funcID', 'estID');
    }



}
