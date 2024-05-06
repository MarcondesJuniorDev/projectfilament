<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EventCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_category';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'order'
    ];
    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($eventCategory) {
            $originalSlug = Str::slug($eventCategory->name);
            $newSlug = $originalSlug;
            $count = 1;

            while (EventCategory::query()->where('slug', $newSlug)->exists()) {
                $newSlug = "{$originalSlug}-" . $count++;
            }

            $eventCategory->slug = $newSlug;
        });

        static::deleting(function($eventCategory) {
            if ($eventCategory->events()->count() > 0 || $eventCategory->children()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir categoria')
                    ->body('Não é possível excluir uma categoria que possui eventos vinculadas.')
                    ->color('danger')
                    ->icon('heroicon-s-x-circle')
                    ->iconColor('danger')
                    ->status('error')
                    ->duration(5000)
                    ->inline()
                    ->send();

                return false;
            }

            return true;
        });
    }


    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'category_id', 'id');
    }
}
