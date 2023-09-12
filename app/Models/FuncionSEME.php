<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionSEME  extends Model
{
    use HasFactory;

    protected $table = 'Funciones_SEME';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'idFuncion';
     protected $fillable = [

        'nombreFuncion',

    ];



    public $timestamps = false;


}
