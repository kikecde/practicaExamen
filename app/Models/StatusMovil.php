<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movil;

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
      'saldoAcumulado',
      'updateSaldo',
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

    public function movil()
    {
        return $this->belongsTo(Movil::class, 'movilID', 'idMovil');
    }


}
