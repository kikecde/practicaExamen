<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusMovil extends Model
{
    use HasFactory;

    protected $table = 'StatusMoviles';

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
      'movilID',
      'statusOperativo',
      'statusFuel',
      'statusOil',
      'statusMecanico',
      'statusSaldo',
      'statusCubiertas',
      'statusMantenimiento',
      'statusConductorOperativo',
      'statusActivo',
      'statusGPS',
      'statusDestinoActual',
      'statusAutonomia',
      'statusConductorID',
      'statusPMD1ID',
      'statusPMD2ID',
      'LAST_UPDATE',
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
    protected $primaryKey = 'idStatusMovil';

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->LAST_UPDATE = now();
        });
    }

    /**
     * Define the relationship between sectors and establishments.
     */
    // public function establecimientos()
    // {
    //     return $this->belongsToMany(Establecimiento::class, 'establecimiento_sector', 'idSector', 'idEst')
    //         ->withPivot('idDepto', 'idSubDepto', 'date_created', 'date_updated')
    //         ->withTimestamps();
    // }



    public function movil()
    {
        return $this->belongsTo(Movil::class, 'movilID', 'idMovil');
    }


    // public function subdepartamentos()
    // {
    //     return $this->belongsToMany(SubDepartamento::class, 'establecimiento_sector', 'idSector', 'idSubDepto');
    // }



}
