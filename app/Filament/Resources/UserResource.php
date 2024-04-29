<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = "Controle de Acesso";

    protected static ?string $modelLabel = "Usuário";

    protected static ?string $pluralModelLabel = "Usuários";

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $activeNavigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados de Login')
                    ->description('Insira os dados de login do usuário.')
                    ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->label('Nome')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->label('E-mail')
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),

                            Forms\Components\TextInput::make('password')
                                ->password()
                                ->label('Senha')
                                ->required(fn(string $operation): bool => $operation === 'create')
                                ->dehydrated(fn(?string $state) => filled($state))
                                ->confirmed()
                                ->visibleOn('create')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('password_confirmation')
                                ->password()
                                ->label('Confirmação de senha')
                                ->requiredWith('password')
                                ->dehydrated(false)
                                ->visibleOn('create')
                                ->maxLength(255),
                        ]),
                Forms\Components\Section::make('Dados Pessoais')
                    ->description('Insira os dados pessoais do usuário.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->avatar()
                            ->label('Avatar')
                            ->disk('public')
                            ->directory('users')
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->preserveFilenames(),
                        Forms\Components\Toggle::make('status')
                            ->label('Status')
                            ->default(false),
                        Forms\Components\Toggle::make('featured_homepage')
                            ->label('Destaque na página inicial')
                            ->default(false),
                        Forms\Components\Select::make('roles')
                            ->label('Funções')
                            ->relationship('roles', 'name')
                            ->multiple(),
                        Forms\Components\Select::make('department')
                            ->label('Departamento')
                            ->relationship('departments', 'name')
                            ->searchable()
                            ->nullable(),
                        Forms\Components\Textarea::make('about')
                            ->label('Sobre')
                            ->rows(3),
                        Forms\Components\TextInput::make('website')
                            ->label('Website')
                            ->url(),
                        Forms\Components\TextInput::make('lattes')
                            ->label('Lattes')
                            ->url(),
                        Forms\Components\TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->url(),
                        Forms\Components\TextInput::make('github')
                            ->label('GitHub')
                            ->url(),
                        Forms\Components\TextInput::make('facebook')
                            ->label('Facebook')
                            ->url(),
                        Forms\Components\TextInput::make('twitter')
                            ->label('Twitter')
                            ->url(),
                        Forms\Components\TextInput::make('instagram')
                            ->label('Instagram')
                            ->url(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Avatar')
                    ->width('40px')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->width('150px')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->width('150px')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->label('Website')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('lattes')
                    ->label('Lattes')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('linkedin')
                    ->label('LinkedIn')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('github')
                    ->label('GitHub')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('facebook')
                    ->label('Facebook')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('twitter')
                    ->label('Twitter')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('instagram')
                    ->label('Instagram')
                    ->width('150px')
                    ->wrap('break-word')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('featured_homepage')
                    ->label('Destaque na página inicial')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('about')
                    ->label('Sobre')
                    ->width('150px')
                    ->wrap('break-word')
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
                //
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
            RelationManagers\RolesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
