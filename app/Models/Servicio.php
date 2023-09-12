<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Departamento;

class Servicio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NombreServ',
        'areasID',
        
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idServ';

    /**
     * Define la relación entre los establecimientos y los distritos.
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'areasID');
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_servicio', 'idServ', 'idArea');
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'servicio_departamento', 'idServ', 'idDepto');
    }

}
