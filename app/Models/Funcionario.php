<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Especialidad;
use App\Models\Distrito;
use App\Models\ProfFuncion;
use App\Models\Servicio;
use App\Models\Establecimiento;
use App\Models\Area;
use App\Models\Departamento;
use App\Models\Sector;
use App\Models\Cargo;
use App\Models\FuncionarioEstablecimiento;
use App\Models\FuncionarioVinculo;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'Funcionarios';

    public $timestamps = true;

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


    public function profesion()
    {
        return $this->belongsTo(ProfFuncion::class, 'funcProfesion_funcion', 'idProfFunc');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'funcEspecialidad', 'idEspecialidadMED');
    }

    // Relación con FuncionarioVinculo
    public function vinculos()
    {
        return $this->hasMany(FuncionarioVinculo::class, 'funcID', 'idFunc');
    }


    public function areas()
    {
        return $this->belongsToMany(Area::class, 'funcionario_establecimiento', 'funcID', 'areaID')
            ->withPivot('estID', 'servID', 'deptoID', 'sectorID', 'deptoNoMedID');
    }

        public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'funcionario_establecimiento', 'funcID', 'servID')
            ->withPivot('estID', 'areaID', 'deptoID', 'sectorID', 'deptoNoMedID');
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'funcionario_establecimiento', 'funcID', 'deptoID')
            ->withPivot('estID', 'areaID', 'servID', 'sectorID', 'deptoNoMedID');
    }

    public function sectores()
    {
        return $this->belongsToMany(Sector::class, 'funcionario_establecimiento', 'funcID', 'sectorID')
            ->withPivot('estID', 'areaID', 'servID', 'deptoID', 'deptoNoMedID');
    }

    public function departamentoNoMedico()
    {
        return $this->belongsToMany(DepartamentoNoMed::class, 'funcionario_establecimiento', 'funcID', 'deptoNoMedID')
            ->withPivot('estID', 'areaID', 'servID', 'deptoID', 'sectorID');
    }

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'Funcionarios_Cargos', 'funcID', 'funcCargosID')
            ->withPivot('funcCargoEst');
    }

    // Relación con FuncionarioEstablecimiento
    public function establecimientos()
    {
        return $this->hasMany(FuncionarioEstablecimiento::class, 'funcID', 'idFunc');
    }


}
