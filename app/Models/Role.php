<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($role) {
            $role->slug = Str::slug($role->name);
        });

        static::deleting(function($role) {
            if ($role->users()->count() > 0) {
                Notification::make()
                    ->title('Erro ao excluir função')
                    ->body('Não é possível excluir uma função que possui usuários vinculados.')
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


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
