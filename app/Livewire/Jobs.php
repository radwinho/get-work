<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\Job;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Jobs extends Component
{
    public $showAlert = true;
    
    public function render()
    {
        return view('livewire.jobs');
    }

    public $search = '';

    #[Computed()]
    public function jobs()
    {
        $jobs = Job::with('user', 'applications')->where('user_id' ,  auth()->id())->where('name' , 'like', "%{$this->search}%")->latest()->paginate(10);

        foreach ($jobs as $job) {
            $job->tags = unserialize($job->tags);
        }
        return $jobs;
    }

    public function apply($jobId)
    {
        Application::create([
            'user_id' => auth()->id(),
            'job_id' => $jobId
        ]);
        
        $jobName = Job::where('id' , $jobId)->first('name'); 
        $jobName = $jobName->name;

        session()->flash('success' , "Successfuly applied to $jobName");

        $this->showAlert = true;
    }
}
