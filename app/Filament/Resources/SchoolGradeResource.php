<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolGradeResource\Pages;
use App\Filament\Resources\SchoolGradeResource\RelationManagers;
use App\Models\Course;
use App\Models\SchoolGrade;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolGradeResource extends Resource
{
    protected static ?string $model = SchoolGrade::class;

    protected static ?string $navigationGroup = "L M S";

    protected static ?string $modelLabel = "Série";

    protected static ?string $pluralModelLabel = "Séries";

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $activeNavigationIcon = 'heroicon-s-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required(),
                Forms\Components\Select::make('course_id')
                    ->label('Curso')
                    ->options(
                        Course::all()->pluck('title', 'id')->toArray()
                    )
                    ->required(),
                Forms\Components\Select::make('subject_id')
                    ->label('Componente Curricular')
                    ->options(
                        Subject::all()->pluck('title', 'id')->toArray()
                    )
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'publicado' => 'Publicado',
                        'rascunho' => 'Rascunho',
                        'pendente' => 'Pendente',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->label('Descrição')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Série')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Curso')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.title')
                    ->label('Componente Curricular')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(function (string $state) : string {
                        return match ($state) {
                            'publicado' => 'success',
                            'rascunho' => 'warning',
                            'pendente' => 'danger',
                        };
                    }),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Autor')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('author')
                    ->label('Autor')
                    ->multiple()
                    ->relationship('author', 'name'),
                Tables\Filters\SelectFilter::make('course')
                    ->label('Cursos')
                    ->multiple()
                    ->relationship('course', 'title'),
                Tables\Filters\SelectFilter::make('subject')
                    ->label('Componentes Curriculares')
                    ->multiple()
                    ->relationship('subject', 'title'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolGrades::route('/'),
            'create' => Pages\CreateSchoolGrade::route('/create'),
            'edit' => Pages\EditSchoolGrade::route('/{record}/edit'),
        ];
    }
}
