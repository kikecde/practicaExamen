<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Movil;

class MarcaMovil extends Model
{
    use HasFactory;

    protected $table = 'Marca_Movil';

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




    public function moviles()
{
    return $this->hasMany(Movil::class, 'marcaMovil', 'idMarcaMovil');
}





}
