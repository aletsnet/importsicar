<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $roles
 * @property int $menu
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Role $role
 * @property Menu $menu
 */
class MenuPermisos extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = ['roles', 'menu', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role', 'roles');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu');
    }
}
