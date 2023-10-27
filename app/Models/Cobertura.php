<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\Distrito;
use App\Models\ConfiguraCobertura;

class Cobertura extends Model
{
    use HasFactory;
    protected $table = 'coberturas';
    protected $primaryKey =  'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'id_cobertura',
        'nombre_cobertura',
    ];

}
