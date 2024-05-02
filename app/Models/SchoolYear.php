<?php

namespace App\Models;

use Filament\Notifications\Notification;
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
            $schoolYear->author_id = auth()->id() ?? User::factory()->create()->id;
        });

        static::deleting(function($schoolYear) {
            if ($schoolYear->lesson()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir Ano Letivo')
                    ->body('Não é possível excluir um ano letivo que esteja vinculado a uma ou mais aulas.')
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
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function lesson(): HasOne
    {
        return $this->hasOne(Lesson::class);
    }
}
