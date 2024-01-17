<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $padre
 * @property int $status
 * @property string $menu
 * @property string $ruta
 * @property string $url
 * @property string $icon
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property CatalogosDetalle $catalogosDetalle
 * @property Menu $menu
 * @property MenuPermiso[] $menuPermisos
 */
class Menu extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'menu';

    /**
     * @var array
     */
    protected $fillable = ['padre', 'status', 'menu', 'ruta', 'url', 'icon', 'created_at', 'updated_at', 'deleted_at'];

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
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'padre');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuPermisos()
    {
        return $this->hasMany('App\MenuPermiso', 'menu');
    }
}
