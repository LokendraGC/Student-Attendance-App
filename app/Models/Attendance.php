<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        "grade_id",
        "student_id",
        "date",
        "status",
        "reason",
    ];

         public function student(): BelongsTo
         {
            return $this->belongsTo(Student::class);
         }

         public function grade(): BelongsTo
         {
            return $this->belongsTo(Grade::class);
         }
}
