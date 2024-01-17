<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $catalogo_id
 * @property string $opcion
 * @property string $valor
 * @property string $icon
 * @property string $css
 * @property string $style
 * @property string $picture
 * @property boolean $activo
 * @property int $orden
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Catalogo $catalogo
 * @property List[] $lists
 * @property Menu[] $menus
 * @property Space[] $spaces
 */
class CatalogosDetalles extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = ['catalogo_id', 'opcion', 'valor', 'icon', 'css', 'style', 'picture', 'activo', 'orden', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalogo()
    {
        return $this->belongsTo('App\Catalogo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lists()
    {
        return $this->hasMany('App\List', 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus()
    {
        return $this->hasMany('App\Menu', 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function spaces()
    {
        return $this->hasMany('App\Space', 'status');
    }
}
