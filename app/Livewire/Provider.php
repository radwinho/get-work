<?php

namespace App\Livewire;

use App\Livewire\Forms\AddJob;
use App\Livewire\Forms\UpdateJob;
use App\Models\Job;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Provider extends Component
{
    use WithPagination;
    public AddJob $createForm;
    public UpdateJob $updateForm;
    public $search = '';
    public $showAlert = true;


    #[Computed]
    public function jobs()
    {
        $jobs = Job::where('user_id' ,  auth()->id())->where('name' , 'like', "%{$this->search}%")->latest()->paginate(3);

        foreach ($jobs as $job) {
            $job->tags = unserialize($job->tags);
        }

        return $jobs;
       
        // $filteredJobs = $jobs->filter(function ($job) {
        //     return strpos($job->name, $this->search) !== false;
        // });

    }

    public function render()
    {
        return view('livewire.provider', ['jobs' => $this->jobs]);
    }

    public function save($tags)
    {
        $this->createForm->tags = $tags;

        $this->createForm->AddJob();
        
        $this->showAlert = true;
    }

    public function setToUpdate(Job $job)
    {
        $this->updateForm->setInputs($job);
    }

    public function edit($tags)
    {
        $this->updateForm->tags = $tags;
        $this->updateForm->update();
    }
}
