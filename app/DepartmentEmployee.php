<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentEmployee extends Model
{
    //
    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function department() {
        return $this->belongsTo('App\Department');
    }

    public function user() {
        return $this->hasOne('App\User');
    }
}
