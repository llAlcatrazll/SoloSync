<?php

namespace App\Filament\Resources;

use App\Enums\GuildAttribution;
use App\Enums\GuildPosition;
use App\Filament\Resources\DragonsListResource\Pages;
use App\Models\Members;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DragonsListResource extends Resource
{
    protected static ?string $model = Members::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::Dragons))

            ->defaultPaginationPageOption(50)
            ->columns([
                TextColumn::make('username')
                    ->columnSpan(2)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('guild_attribution')
                    ->columnSpan(2)
                    ->color(fn ($state) => GuildAttribution::from($state)->getColor())
                    ->icon(fn ($state) => GuildAttribution::from($state)->getIcon())
                    ->sortable(),
                TextColumn::make('role')
                    ->columnSpan(1)
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->color(fn ($state) => GuildPosition::from($state)->getColor()),
                TextColumn::make('battle_tier')
                    ->alignment(Alignment::Center)
                    ->columnSpan(1)
                    ->sortable(),
                TextInputColumn::make('Contribution')
                    ->placeholder('38'),
                // TextColumn::make('Prev Contribution'),
                TextInputColumn::make('Rage Count')
                    ->placeholder('40'),
                // TextColumn::make('Prev Rage Count'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDragonsLists::route('/'),
            'create' => Pages\CreateDragonsList::route('/create'),
            // 'edit' => Pages\EditDragonsList::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
