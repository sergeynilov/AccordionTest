<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;


class ModelHasPermission extends Model
{
    protected $table      = 'model_has_permissions';
    protected $primaryKey = 'id';
    public $timestamps    = false;


    /**
     * An model is owned by a user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'model_id');
    }

    /**
     * returns filtered query by permission if $permission_id param is not empty
     * @param Int $permission_id
     * returns $query object
     */
    public function scopeGetByPermissionId($query, $permission_id)
    {
        return $query->where(with(new ModelHasPermission)->getTable() . '.permission_id', $permission_id);
    }


    /**
     * returns filtered query by model_id if $model_id param is not empty
     * @param Int $model_id
     * returns $query object
     */
    public function scopeGetByModelId($query, $model_id)
    {
        return $query->where(with(new ModelHasPermission)->getTable() . '.model_id', $model_id);
    }


}

