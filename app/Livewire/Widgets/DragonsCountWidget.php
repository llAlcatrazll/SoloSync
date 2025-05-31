<?php

namespace App\Livewire\Widgets;

use App\Models\Members;
use Livewire\Component;

class DragonsCountWidget extends Component
{
    public array $stats = [];

    public function mount()
    {
        $count = Members::where('guild_attribution', 'Dragons')->count();
        $this->stats = [
            [
                'label' => 'Active Members',
                'value' => $count,
                'description' => 'Requests that have been accepted',
                'descriptionIcon' => 'heroicon-o-check-circle',
                'color' => 'success',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.widgets.dragons-count-widget');
    }
}
