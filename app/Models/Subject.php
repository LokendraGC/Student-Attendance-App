<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "grade_name",
    ];

    public function atttendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
    public function students(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function teacher(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }
}
