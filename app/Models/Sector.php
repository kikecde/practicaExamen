<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establecimiento;

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
     * Define the relationship between sectors and establishments.
     */
    public function establecimientos()
    {
        return $this->belongsToMany(Establecimiento::class, 'establecimiento_sector', 'sectorID', 'estID');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamentoID');
    }


}
