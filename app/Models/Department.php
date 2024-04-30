<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'responsible_id',
        'parent_id',
        'author_id',
        'order',
        'summary',
        'description',
        'image',
        'status',
        'bg_color',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($department) {
            $department->slug = Str::slug($department->name);
            $department->author_id = auth()->id() ?? User::factory()->create()->id;
        });

        static::deleting(function($department) {
            if ($department->users()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir departamento')
                    ->body('Não é possível excluir um departamento que possui usuários vinculados.')
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

    public function responsible(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'responsible_id');
    }

    public function parent(): HasOne
    {
        return $this->hasOne(__CLASS__, 'id', 'parent_id');
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'department_user', 'department_id', 'user_id');
    }
}
