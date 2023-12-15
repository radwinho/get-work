<?php

namespace App\Livewire;

use App\Models\Job;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Seeker extends Component
{
    public function render()
    {
        return view('livewire.seeker');
    }

    public $search = '';

    #[Computed()]
    public function jobs()
    {
        $jobs = User::find(auth()->id())->applications()->where('name' , 'like', "%{$this->search}%")->latest()->paginate(10);
        // where('name' , 'like', "%{$this->search}%")->latest()->paginate(10);
        
        foreach ($jobs as $job) {
            $job->tags = unserialize($job->tags);
        }

        return $jobs;
    }

}
