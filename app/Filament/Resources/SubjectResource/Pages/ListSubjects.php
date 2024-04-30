<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use App\Filament\Resources\SubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubjects extends ListRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => ListRecords\Tab::make(),
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
