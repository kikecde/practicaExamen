<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;
use App\Models\VinculoOrden;
use App\Models\VinculoTipoMSPBS;
use App\Models\FuncionarioVinculo;

class VinculoInstitucion extends Model
{
    use HasFactory;

    protected $table = 'vinculos_instituciones';
    protected $primaryKey = 'id_vinc_inst';

    protected $fillable = [
        'name_institucion',
        // Agrega aquí los demás atributos si los tienes
    ];

    public function funcionarioVinculos()
{
    return $this->hasMany(FuncionarioVinculo::class, 'InstitVinc');
}
}
