<?php

namespace App\Filament\Resources;

use App\Enums\GuildAttribution;
use App\Enums\GuildPosition;
use App\Enums\Status;
use App\Filament\Resources\GunheeResource\Pages;
use App\Models\Members;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

// https://filamentexamples.com/tutorial/render-hooks-cheat-sheet
class GunheeResource extends Resource
{
    // https://laraveldaily.com/post/filament-add-form-on-top-above-the-table
    protected static ?string $model = Members::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('username')
                    ->placeholder('Luci')
                    ->columnSpan(2)
                    ->required(),

                Select::make('guild_attribution')
                    ->required()
                    ->columnSpan(2)
                    ->options(
                        collect(GuildAttribution::cases())->mapWithKeys(fn ($case) => [
                            $case->value => $case->name,
                        ])->toArray()
                    )
                    ->getOptionLabelUsing(fn ($value) => GuildAttribution::from($value)->name),

                Select::make('role')
                    ->columnSpan(3)
                    ->required()
                    ->options(GuildPosition::options()),

                TextInput::make('battle_tier')
                    ->columnSpan(2)
                    ->placeholder('45'),

                // Actions::make([
                //     Action::make('create')
                //         ->label('Create')
                //         ->color('warning')
                //         ->submit('create'),
                // ])
                // ->grow(false)
                // ->columnSpan(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(50)
            ->columns([
                TextColumn::make('username')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('guild_attribution')
                    ->color(fn ($state) => GuildAttribution::from($state)->getColor())
                    ->icon(fn ($state) => GuildAttribution::from($state)->getIcon())
                    ->sortable(),
                TextColumn::make('role')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->color(fn ($state) => GuildPosition::from($state)->getColor()),
                TextColumn::make('battle_tier')->sortable(),
                TextColumn::make('permission')->sortable()->searchable()->toggleable(),
                TextColumn::make('status'),
                // SelectColumn::make('status')
                //     ->options(Status::options())
                //     ->sortable()
                //     ->searchable()
                //     ->extraAttributes(['class' => 'truncate'])
                //     ->afterStateUpdated(function ($record, $state) {
                //         $record->status = $state;
                //         $record->save();
                //     }),

            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                ActionGroup::make([
                    // ApproveBookingAction::make(),
                    // DeclineBookingAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGunhees::route('/'),
            'create' => Pages\CreateGunhee::route('/create'),
            // 'edit' => Pages\EditGunhee::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationLabel(): string
    {
        return 'Member Management';
    }
}
