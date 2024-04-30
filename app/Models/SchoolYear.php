<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'year',
        'is_current',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($schoolYear) {
            $schoolYear->author_id = auth()->id() ?? SchoolYear::factory()->create()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
