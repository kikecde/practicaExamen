<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FuncionarioVinculo;

class VinculoTipoMSPBS extends Model
{
    use HasFactory;

    protected $table = 'vinculo_mspbs_tipo';
    protected $primaryKey = 'idTipoVinculoMSPBS';

    protected $fillable = [
        'NombreTipoVinculo',
        'AbrevTipoVinculo',
        // Agrega aquí los demás atributos si los tienes
    ];

    public function funcionarioVinculos()
{
    return $this->hasMany(FuncionarioVinculo::class, 'VincTipoMSPBS');
}


}