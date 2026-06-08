<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TentangPascasarjanaResource\Pages;
use App\Models\TentangPascasarjana;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class TentangPascasarjanaResource extends Resource
{
    protected static ?string $model = TentangPascasarjana::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Tentang Pascasarjana';

    protected static ?string $pluralModelLabel = 'Tentang Pascasarjana';

    protected static string|UnitEnum|null $navigationGroup = 'Profil';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Teks Utama (Bagian Kiri)')
                    ->schema([
                        Forms\Components\TextInput::make('subheading')
                            ->required()
                            ->default('Tentang Kami')
                            ->label('Sub Judul')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('heading')
                            ->required()
                            ->label('Judul Utama')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->label('Deskripsi')
                            ->rows(6),
                    ])->columnSpan(1),

                Forms\Components\Section::make('Poin-Poin Utama (Bagian Kanan)')
                    ->schema([
                        Forms\Components\Repeater::make('points')
                            ->schema([
                                Forms\Components\FileUpload::make('icon')
                                    ->image()
                                    ->directory('tentang-icons')
                                    ->label('Ikon (SVG/PNG transparan)'),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->label('Judul Poin (Contoh: Kelebihan)'),
                                Forms\Components\Textarea::make('description')
                                    ->required()
                                    ->label('Deskripsi Singkat')
                                    ->rows(3),
                            ])
                            ->defaultItems(3)
                            ->columns(1)
                    ])->columnSpan(1)
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subheading')->searchable(),
                Tables\Columns\TextColumn::make('heading')->searchable()->limit(40),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime()
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTentangPascasarjanas::route('/'),
            'create' => Pages\CreateTentangPascasarjana::route('/create'),
            'edit' => Pages\EditTentangPascasarjana::route('/{record}/edit'),
        ];
    }
}
