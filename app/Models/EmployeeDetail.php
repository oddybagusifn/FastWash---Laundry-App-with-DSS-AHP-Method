<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeDetail extends Model
{
    protected $fillable = [
        'employee_id',
        'job_desk_id',
        'employment_type',
        'salary',
    ];

    protected $appends = ['employment_type_label'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function jobDesk(): BelongsTo
    {
        return $this->belongsTo(JobDesk::class);
    }

    public function getEmploymentTypeLabelAttribute(): string
    {
        return match ($this->employment_type) {
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            default => '-',
        };
    }
}
