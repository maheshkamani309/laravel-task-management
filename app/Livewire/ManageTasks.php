<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTasks extends Component
{
    use WithPagination;
    public $action = 'view';
    public $task = [];
    public $projects = null;
    public $deleteConfirm = false;
    public $selectedProject = 0;

    protected $rules = [
        'task.name' => 'required|min:6',
        'task.project_id' => 'required',
        'task.priority' => 'required',
    ];

    protected $messages = [
        'task.name' => 'Please enter task name',
        'task.project_id' => 'Please select project',
        'task.priority' => 'Please enter task priority',
    ];
    
    public function mount(){
        $this->projects= Project::all();
    }

    public function render()
    {
        if(empty($this->selectedProject)){
            $tasks = Task::orderBy('priority')->get();
        } else {
            $tasks = Task::orderBy('priority')->where('project_id', $this->selectedProject)->get();
        }
        return view('livewire.manage-tasks', ['tasks' => $tasks]);
    }

    public function filterBy(){
    }

    public function updateTaskOrder($tasks) {
        foreach($tasks as $task) {
            Task::find($task['value'])->update(['priority' => $task['order']]) ;
        }
    }

    public function editTask(Task $task){
        $this->action='edit';
        $this->task = $task->toArray();
    }

    public function newTask(){
        $this->action='new';
        $this->task = [];
    }

    public function confirmDelete(Task $task){        
        $this->deleteConfirm = true;      
        $this->task = $task->toArray();
    }
    public function deleteTask(){        
        $this->deleteConfirm = false;        
        Task::find($this->task['id'])->delete();
        $this->backToView();
    }

    public function deleteCancel(){        
        $this->deleteConfirm = false;        
        // $this->task = [];
    }
    
    public function saveTask(){

        $this->validate();
        
        if(isset($this->task['id'])){
            $new_task = Task::find($this->task['id']);
        } else {
            $new_task = new Task();
        }
        $new_task->priority = 1;
        $new_task->name = $this->task['name'];
        $new_task->project_id = $this->task['project_id'];
        $new_task->priority = $this->task['priority'];
        $new_task->save();
        $this->backToView();
    }

    public function backToView(){
        $this->action='view';
        $this->task = [];
    }
}
