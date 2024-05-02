<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'todos' => ListRecords\Tab::make(),
            'publicado' => ListRecords\Tab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'publicado');
            }),
            'rascunho' => ListRecords\Tab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'rascunho');
            }),
            'pendente' => ListRecords\Tab::make()->modifyQueryUsing(function ($query) {
                $query->where('status', 'pendente');
            }),
        ];
    }
}
