<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    //

    protected $table = 'TBL_PRIVILEGE';
    protected $primaryKey = 'USER_PRIVILEGE_ID';
    protected $fillable = ['USER_PRIVILEGE_DESC'];


    public function scopeUserGroupExist($query, $id)
    {
        $query->where('USER_PRIVILEGE_ID', $id);
    }

}
