<?php

namespace App\Filament\Resources;

use App\Enums\GuildAttribution;
use App\Enums\GuildPosition;
use App\Enums\Permissions;
use App\Enums\Status;
use App\Filament\Resources\GunheeResource\Pages;
use App\Models\Members;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GunheeResource extends Resource
{
    protected static ?string $model = Members::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('username')->placeholder('Luci'),

                Select::make('guild_attribution')
                    ->options(
                        collect(GuildAttribution::cases())->mapWithKeys(fn ($case) => [
                            $case->value => $case->name,
                        ])->toArray()
                    )
                    ->getOptionLabelUsing(fn ($value) => tap(GuildAttribution::from($value), function ($case) {
                        //
                    })->name)
                    ->suffixIcon(fn ($state) => GuildAttribution::from($state)?->getIcon()),
                Select::make('role')
                    ->required()
                    ->options(GuildPosition::options()),
                TextInput::make('battle_tier'),
                Hidden::make('permission')
                    ->default(Permissions::None),
                Hidden::make('status')
                    ->default(Status::Active),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(50)
            ->columns([
                //
                TextColumn::make('username')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('guild_attribution'),
                TextColumn::make('role'),
                TextColumn::make('battle_tier'),
                TextColumn::make('permission'),
                TextColumn::make('status'),
                // TextColumn::make('contribution'),
                // TextColumn::make('contribution')
                // ->label('Prev Contribution'),
                // TextColumn::make('rage_count')
                // ->label('Prev RageCount'),
                // TextColumn::make('rage_count'),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGunhees::route('/'),
            'create' => Pages\CreateGunhee::route('/create'),
            'edit' => Pages\EditGunhee::route('/{record}/edit'),
        ];
    }
}
