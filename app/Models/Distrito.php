<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;

class Distrito extends Model
{
    use HasFactory;
    protected $table = 'Distritos';
    protected $primaryKey =  'idDistrito';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'NombreDistrito',
        'AbrevDistrito',
        'distrUbicacionLatitud',
        'distrUbicacionLongitud',
        'regionID',
        'codDistrito',
    ];

    public function region()
{
    return $this->belongsTo(Region::class, 'regionID', 'idRegion');
}

}
