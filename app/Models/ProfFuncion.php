<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfFuncion extends Model
{
    use HasFactory;

    protected $table = 'ProfesionFuncion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'idProfFunc';
     protected $fillable = [
       
        'NombProfes',
        'ProfFuncAbrev'
        
    ];

   
    
    public $timestamps = false;


}