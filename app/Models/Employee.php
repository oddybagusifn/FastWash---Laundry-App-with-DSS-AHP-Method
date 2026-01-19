<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    protected $fillable = ['employee_name'];

    public function detail(): HasOne
    {
        return $this->hasOne(EmployeeDetail::class);
    }
}
