<?php

namespace App\Livewire\Site\Components;

use Illuminate\View\View;
use Livewire\Component;

class DarkMode extends Component
{
    public bool $darkMode = false;

    public function toggleDarkMode(): void
    {
        $this->darkMode = !$this->darkMode;

        if ($this->darkMode) {
            session()->put('dark-mode', true);
        } else {
            session()->forget('dark-mode');
        }
    }

    public function render(): View
    {
        return view('livewire.site.components.dark-mode');
    }
}
