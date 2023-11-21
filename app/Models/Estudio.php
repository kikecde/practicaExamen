<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;
use App\Models\Establecimiento;

class Estudio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombreEstudio',
        'servID',


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
    protected $primaryKey = 'idEstudio';

    public function establecimientos()
    {
        return $this->belongsToMany(Establecimiento::class, 'establecimiento_estudio', 'idEstudio', 'estID')
                    ->withPivot('is_active');
    }


    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servID');
    }




}
