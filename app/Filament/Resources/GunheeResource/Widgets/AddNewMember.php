<?php

namespace App\Filament\Resources\GunheeResource\Widgets;

use App\Enums\GuildAttribution;
use App\Enums\GuildPosition;
use App\Enums\Permissions;
use App\Enums\Status;
use App\Models\Members;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class AddNewMember extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.gunhee-resource.widgets.add-new-member';

    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    // https://laraveldaily.com/post/filament-add-form-on-top-above-the-table
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(10)->schema([
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
                        ->maxLength(2)
                        ->placeholder('45'),

                    Actions::make([
                        Action::make('create')
                            ->label('Create')
                            ->color('warning')
                            ->submit('create'),
                    ])
                        ->grow(false)
                        ->columnSpan(1),
                ]),

                // Hidden fields (can be outside the grid)
                Hidden::make('permission')->default(Permissions::None),
                Hidden::make('status')->default(Status::Active),
            ])
            ->statePath('data');
    }

    public function create()
    {
        $data = $this->form->getState();

        Members::create([
            'username' => $data['username'],
            'guild_attribution' => $data['guild_attribution'],
            'role' => $data['role'],
            'battle_tier' => $data['battle_tier'],
            'permission' => $data['permission'] ?? \App\Enums\Permissions::None,
            'status' => $data['status'] ?? \App\Enums\Status::Active,
        ]);

        $this->form->fill(); // Reset form
        $this->dispatch('notify', type: 'success', message: 'Member added successfully.');
        $this->dispatch('newmemberAdded');
    }
}
