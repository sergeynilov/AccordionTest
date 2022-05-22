<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{
    //
    protected $table      = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];

    /**
     * returns filtered query by name if $name param is not empty
     * @param String $name
     * returns $query object
     */
    public function scopeGetUserByName($query, $name= null)
    {
        if (!empty($name)) {
            $query->where(with(new User)->getTable().'.name', $name);
        }
        return $query;
    }

}
