<?php

namespace App\Http\Livewire\Newsletter;

use Livewire\Component;

class Form extends Component
{
    public  string $name = '';
    public string $email = '';
    public function render()
    {
        return view('livewire.newsletter.form');
    }
    public function formSubmit()
    {
    }
}
