<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'author_id',
        'school_grade_id',
        'subject_id',
        'course_id',
        'school_year_id',
        'title',
        'slug',
        'code',
        'image',
        'description',
        'status',
        'lesson_date',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($lesson) {
            $lesson->author_id = auth()->id() ?? User::factory()->create()->id;
            $lesson->slug = Str::slug($lesson->title);
        });

        static::deleting(function($lesson) {
            if ($lesson->contents()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir Aula')
                    ->body('Não é possível excluir uma aula que possui conteúdos.')
                    ->color('danger')
                    ->icon('heroicon-s-x-circle')
                    ->iconColor('danger')
                    ->status('error')
                    ->duration(5000)
                    ->inline()
                    ->send();
                return false;
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function schoolGrade(): BelongsTo
    {
        return $this->belongsTo(SchoolGrade::class, 'school_grade_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

    public function contents(): HasMany
    {
        return $this->hasMany(LessonContent::class);
    }

}
