<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $space
 * @property int $status
 * @property string $color
 * @property string $lote
 * @property string $paquete
 * @property string $kilos
 * @property string $costo
 * @property string $presio
 * @property string $numero
 * @property string $repetido
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property CatalogosDetalle $catalogosDetalle
 * @property Space $space
 */
class Listas extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'list';

    /**
     * @var array
     */
    protected $fillable = ['space', 'status', 'color', 'lote', 'paquete', 'kilos', 'costo', 'presio', 'numero', 'repetido', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalogosDetalle()
    {
        return $this->belongsTo('App\CatalogosDetalle', 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function space()
    {
        return $this->belongsTo('App\Space', 'space');
    }
}
