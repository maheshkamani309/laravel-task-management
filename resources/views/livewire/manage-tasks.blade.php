<div>
    @if($deleteConfirm == true)
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Delete Task</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete your task? All of your data will be permanently removed. This action cannot be undone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" wire:click="deleteTask">Yes, Sure</button>
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" wire:click="deleteCancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
    @if($action == 'view')
    <div class="mb-5 flex justify-end">
        <form wire:submit="filterBy">
            <div class="mr-3 flex justify-end">

                <select wire:model="selectedProject" class="block w-full rounded-md px-3 py-2 mr-3 ">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-md  text-sm font-semibold  px-3 py-2 hover:opacity-75 w-44 bg-[#FF2D20] text-white">Filter</button>
            </div>
        </form>

        <button type="button" wire:click="newTask" class="rounded-md  text-sm font-semibold  px-3 py-2 hover:opacity-75 w-44 bg-[#FF2D20] text-white">Create New Task</button>
    </div>
    <ul wire:sortable="updateTaskOrder" role="list" class="rounded-md divide-y divide-gray-100 bg-[#111827] text-white mb-8">
        <li class="grid grid-cols-7 gap-4 justify-between gap-x-6 py-5 px-5 font-bold">
            <div class="">
                <p>Change Priority</p>
            </div>
            <div class="col-span-3">
                <p>Task Name</p>
            </div>
            <div class="col-span-2">
                <p>Project</p>
            </div>
            <div class="">
                <p>Action</p>
            </div>
        </li>
        @forelse($tasks as $task)
        <li wire:sortable.item="{{ $task->id }}" wire:key="{{$task->id}}" class="grid grid-cols-7 gap-4 justify-between gap-x-6 py-5 px-5 bg-white text-[#111827] font-semibold">
            <div>
                <span wire:sortable.handle class="cursor-move">Move </span>
            </div>
            <div class="col-span-3">
                <p>{{ $task->name }}</p>
            </div>
            <div class="col-span-2">
                <p>{{ $task->project->name }}</p>
            </div>
            <div class="flex  ">
                <a class="cursor-pointer rounded-md text-sm font-semibold h-9 px-3 py-2 hover:opacity-75 w-44 bg-[#567260] text-white mr-4 text-center" wire:click="editTask({{$task->id}})" class="mr-4">Edit</a>
                <a class="cursor-pointer rounded-md text-sm font-semibold h-9 d-inline px-3 py-2 hover:opacity-75 w-44 bg-[#FF2D20] text-white" wire:click="confirmDelete({{$task->id}})">Delete</a>
            </div>
        </li>
        @empty
        <li class="grid grid-cols-7 gap-4 justify-between gap-x-6 py-5 px-5 bg-white text-[#111827] font-semibold">
            <div class="col-span-7">
                <p>No tasks found. Please create new one.</p>
            </div>
        </li>
        @endforelse
    </ul>
    @else
    <div class="bg-[#111827] text-white p-5 rounded-md divide-y divide-gray-100 mb-8">
        <h2 class="text-3xl font-bold uppercase mb-6">{{$action}} Task</h2>
        <form wire:submit="saveTask" class="bg-white text-black p-10 rounded-md">
            <div class="space-y-12">
                <div class="pb-12">
                    <div class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="taskname" class="block text-sm">Name</label>
                            <div class="mt-2">
                                <div class="flex shadow-sm">
                                    <input wire:model="task.name" type="text" name="taskname" id="taskname" class="block w-full rounded-md py-1.5">
                                </div>
                                @error('task.name') <span class="error text-[#FF2D20]">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="project_id" class="block text-sm font-medium leading-6 ">Select Project</label>
                            <div class="mt-2">
                                <select re wire:model="task.project_id" id="project_id" name="project_id" class="block w-full rounded-md py-1.5 ">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                                @error('task.project_id') <span class="error text-[#FF2D20]">{{ $message }}</span> @enderror
                            </div>

                        </div>
                        <div class="sm:col-span-4">
                            <label for="priority" class="block text-sm">Priority</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm">
                                    <input wire:model="task.priority" type="number" name="priority" id="priority" class=" block w-full rounded-md py-1.5">
                                </div>
                                @error('task.priority') <span class="error text-[#FF2D20]">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-start gap-x-6">
                <button type="submit" class="rounded-md bg-[#567260] px-3 py-2 text-white w-20">Save</button>
                <button type="button" wire:click="backToView" class="rounded-md font-semibold w-20 py-2 bg-black text-white">Back</button>
                @if($task)
                <button type="button" wire:click="confirmDelete({{$task['id']}})" class="rounded-md font-semibold w-20 py-2 bg-[#FF2D20] text-white">Delete</button>
                @endif
            </div>
        </form>
    </div>
    @endif

</div>