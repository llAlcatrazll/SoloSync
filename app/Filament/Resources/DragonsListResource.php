<?php

namespace App\Filament\Resources;

use App\Enums\GuildAttribution;
use App\Enums\GuildPosition;
use App\Enums\Status;
use App\Filament\Resources\DragonsListResource\Pages;
use App\Models\Contribution;
use App\Models\Members;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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
                TextInput::make('battle_tier'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::Dragons)->where('status', Status::Active))
            ->defaultPaginationPageOption(25)
            // testing commit
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
                    ->sortable(
                        query: fn (Builder $query, string $direction) => $query->orderByRaw("
                                CASE
                                    WHEN role = 'Leader' THEN 1
                                    WHEN role = 'ViceLeader' THEN 2
                                    WHEN role = 'Member' THEN 3
                                    ELSE 4
                                END $direction
                            ")
                    )
                    ->searchable()
                    ->color(fn ($state) => GuildPosition::from($state)->getColor()),
                TextColumn::make('battle_tier')
                    ->default('1')
                    ->alignment(Alignment::Center)
                    ->columnSpan(1)
                    ->sortable(),
                TextColumn::make('Contribution')
                    ->getStateUsing(function ($record) {
                        $contribution = Contribution::where('member_id', $record->id)->latest()->first();

                        return $contribution?->contribution ?? '0';
                    }),
                TextColumn::make('Rage Count')
                    ->getStateUsing(function ($record) {
                        $contribution = Contribution::where('member_id', $record->id)->latest()->first();

                        return $contribution?->rage_count ?? '0';
                    }),
            ])
            ->persistSortInSession()
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
