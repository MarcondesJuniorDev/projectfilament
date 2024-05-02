<?php

namespace App\Filament\Resources\LessonResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContentsRelationManager extends RelationManager
{
    protected static string $relationship = 'contents';

    protected static ?string $label = 'Conteúdo';

    protected static ?string $title = 'Conteúdo da Aula';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->required(),
                Forms\Components\Toggle::make('is_main')
                    ->label('Principal'),
                Forms\Components\Toggle::make('is_file')
                    ->label('É arquivo?'),
                Forms\Components\Select::make('content_type')
                    ->label('Tipo de Conteúdo')
                    ->live()
                    ->options([
                        'url' => 'URL',
                        'youtube' => 'Youtube',
                        'mp4' => 'Vídeo MP4',
                        'doc' => 'Documento Word',
                        'ppt' => 'Apresentação PowerPoint',
                        'xls' => 'Planilha Excel',
                        'pdf' => 'PDF',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('content_value')
                    ->label('URL do Conteúdo')
                    ->type('url')
                    ->visible(fn(Forms\Get $get): bool => $get('content_type') === 'url' || $get('content_type') === 'youtube')
                    ->required(),
                Forms\Components\FileUpload::make('content_value')
                    ->label('Arquivo do Conteúdo')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'video/mp4'])
                    ->visible(fn(Forms\Get $get): bool => $get('content_type') !== 'url' && $get('content_type') !== 'youtube')
                    ->required(),

            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->label('Título'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição'),
                Tables\Columns\IconColumn::make('is_main')
                    ->label('Principal')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_file')
                    ->label('É arquivo?')
                    ->boolean(),
                Tables\Columns\TextColumn::make('author.name')
                    ->sortable()
                    ->searchable()
                    ->label('Autor')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('content_type')
                    ->label('Tipo de Conteúdo')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('content_value')
                    ->label('Conteúdo')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('author')
                    ->label('Autor')
                    ->searchable()
                    ->relationship('author', 'name'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
