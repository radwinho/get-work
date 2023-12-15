<?php

namespace App\Livewire\Forms;

use App\Models\Job;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AddJob extends Form
{
    #[Rule('required|string')]
    public $name;

    #[Rule('required|string|max:40')]
    public $location;

    #[Rule('required|string|max:20')]
    public $type = 'Full Time';

    public $tags;

    public $showCreate = false;

    public function AddJob()
    {
        // run validation rules
        $this->validate();

        // create job
        Job::create([
            'name' => $this->name,
            'tags' => serialize($this->tags),
            'location' => $this->location,
            'type' => $this->type,
            'user_id' => auth()->id(),
        ]);

        $this->reset();

        session()->flash('success' , 'Successfuly Created');
       
        $this->showCreate = false;
    }
}
