<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function departmentEmployees() {
        return $this->hasMany('App\DepartmentEmployee');
    }
    
}
