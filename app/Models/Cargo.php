<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Establecimiento;
use App\Models\FuncionarioCargo;
use App\Models\Area;

class Cargo  extends Model
{
    use HasFactory;

    protected $table = 'Cargos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'idCargos';
     protected $fillable = [

        'nombreCargo',
        'areaID',
    ];

    public function area()
{
    return $this->belongsTo(Area::class, 'areaID');
}

}
