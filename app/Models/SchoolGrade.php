<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'course_id',
        'subject_id',
        'title',
        'description',
        'status',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($schoolGrade) {
            $schoolGrade->author_id = auth()->id() ?? User::factory()->create()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
