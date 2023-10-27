<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FuncionarioVinculo;

class VinculoOrden extends Model
{
    use HasFactory;

    protected $table = 'vinculos_orden';
    protected $primaryKey = 'idOrdenVinc';

    protected $fillable = [
        'nameOrdenVinc',
        // Agrega aquí los demás atributos si los tienes
    ];

    public function funcionarioVinculos()
{
    return $this->hasMany(FuncionarioVinculo::class, 'OrdenVinculo');
}


}

