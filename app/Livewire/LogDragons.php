<?php

namespace App\Livewire;

use App\Enums\GuildAttribution;
use App\Enums\Status;
use App\Models\Contribution;
use App\Models\Members;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LogDragons extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected static ?string $model = Contribution::class;

    public $showForm = false;

    public $message = '';

    public function openForm()
    {
        $this->showForm = true;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('member_id')
                    ->options(Members::all()->where('guild_attribution', GuildAttribution::Dragons)->where('status', Status::Active)->pluck('username', 'id')),
                TextInput::make('contribution')
                    ->placeholder('2250'),
                TextInput::make('rage_count')
                    ->required(),
                TextInput::make('week_count')
                    ->required()
                    ->placeholder('60'),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        Contribution::create([
            'member_id' => $data['member_id'],
            'contribution' => $data['contribution'],
            'rage_count' => $data['rage_count'],
            'week_count' => $data['week_count'],
        ]);
        $this->form->fill();
        $this->dispatch('notify', type: 'success', message: 'Data logged successfully');
        $this->dispatch('Data Logged');
    }

    public function submit()
    {
        $this->reset(['showForm', 'message']);
        session()->flash('message', 'Feedback submitted!');
    }

    public function render(): View
    {
        return view('livewire.log-dragons');
    }
}
