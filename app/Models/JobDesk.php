<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class JobDesk extends Model
{
protected $fillable = ['job_name'];


public function employeeDetails(): HasMany
{
return $this->hasMany(EmployeeDetail::class);
}
}
