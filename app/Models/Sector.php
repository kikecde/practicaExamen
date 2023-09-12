<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Sectores';

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
        'NombreSector',
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
    protected $primaryKey = 'idSector';

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->date_created = now();
        });

        static::updating(function ($model) {
            $model->date_updated = now();
        });
    }

    /**
     * Define the relationship between sectors and establishments.
     */
    public function establecimientos()
    {
        return $this->belongsToMany(Establecimiento::class, 'establecimiento_sector', 'idSector', 'idEst')
            ->withPivot('idDepto', 'idSubDepto', 'date_created', 'date_updated')
            ->withTimestamps();
    }



    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'establecimiento_sector', 'idSector', 'idDepto');
    }

    public function subdepartamentos()
    {
        return $this->belongsToMany(SubDepartamento::class, 'establecimiento_sector', 'idSector', 'idSubDepto');
    }


   
}
