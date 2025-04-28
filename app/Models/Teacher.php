<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{

    protected $fillable = [
        "name",
        "email",
        "phone",
        "user_id",
        "subject_id",
        "subject_to_teach",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
