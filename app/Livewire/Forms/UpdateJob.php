<?php

namespace App\Livewire\Forms;

use App\Models\Job;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UpdateJob extends Form
{
    public $showUpdate = false;

    public $id;

    #[Rule('required|string')]
    public $name = '';

    #[Rule('required|string|max:40')]
    public $location = '';

    #[Rule('required|string|max:20')]
    public $type;

    public $tags = [];

    public function setInputs($job)
    {  
        $this->id       = $job->id;
        $this->name     = $job->name;
        $this->location = $job->location;
        $this->type     = $job->type;
        $this->tags     = unserialize($job->tags);

        $this->validate();
    }

    public function update()
    {
        $this->validate();

        Job::find($this->id)->update([
            'name' => $this->name,
            'location' => $this->location,
            'type' => $this->type,
            'tags' => serialize($this->tags),
        ]);        

        $this->showUpdate = false;
    }
}
