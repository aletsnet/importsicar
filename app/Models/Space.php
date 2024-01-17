<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $status
 * @property string $proceso
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property CatalogosDetalle $catalogosDetalle
 * @property List[] $lists
 */
class Space extends Model
{
    use SoftDeletes;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'space';

    /**
     * @var array
     */
    protected $fillable = ['status', 'proceso', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalogosDetalle()
    {
        return $this->belongsTo('App\CatalogosDetalle', 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lists()
    {
        return $this->hasMany('App\List', 'space');
    }
}
