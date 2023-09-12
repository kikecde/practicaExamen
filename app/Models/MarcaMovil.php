<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaMovil extends Model
{
    use HasFactory;

    protected $table = 'MarcaMovil';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'nombreMarcaMovil',
      'marcaLogoPath',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idMarcaMovil';




    // public function movil()
    // {
    //     return $this->belongsTo(Movil::class, 'movilID', 'idMovil');
    // }


    // public function subdepartamentos()
    // {
    //     return $this->belongsToMany(SubDepartamento::class, 'establecimiento_sector', 'idSector', 'idSubDepto');
    // }



}
