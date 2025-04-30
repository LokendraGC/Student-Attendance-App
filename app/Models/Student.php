<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, HasRoles;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "phone",
        "certificate",
        "image",
        "grade_id",
        "subject_id",
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    // one student has many attendance
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    // one student has many subject
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
