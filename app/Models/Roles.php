<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $nombre
 * @property string $icon
 * @property string $css
 * @property string $style
 * @property string $picture
 * @property boolean $activo
 * @property int $orden
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property MenuPermiso[] $menuPermisos
 * @property User[] $users
 */
class Roles extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'icon', 'css', 'style', 'picture', 'activo', 'orden', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuPermisos()
    {
        return $this->hasMany('App\MenuPermiso', 'roles');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'rol_id');
    }
}
