<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function departmentEmployees() {
        return $this->hasMany('App\DepartmentEmployee');
    }
    
}
