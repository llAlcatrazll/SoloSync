<?php

namespace App\Livewire;

use Livewire\Component;

class LogDragons extends Component
{
    public $showForm = false;

    public $message = '';

    public function openForm()
    {
        $this->showForm = true;
    }

    public function submit()
    {
        // Process the message (e.g., save to DB)
        $this->reset(['showForm', 'message']);
        session()->flash('message', 'Feedback submitted!');
    }

    public function render()
    {
        return view('livewire.log-dragons');
    }
}
