<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $project->name }}
            </h2>
            <a href="{{ route('projects.tasks.create', $project) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Project Details</h3>
                        <p class="text-gray-600">{{ $project->description }}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <span class="text-gray-600">Status:</span>
                            <span class="font-semibold">{{ ucfirst($project->status) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Due Date:</span>
                            <span class="font-semibold">{{ $project->due_date->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Tasks</h3>
                    @if($project->tasks->isEmpty())
                        <p class="text-gray-500">No tasks found.</p>
                    @else
                        <div class="grid gap-4">
                            @foreach($project->tasks as $task)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-semibold">{{ $task->title }}</h4>
                                            <p class="text-sm text-gray-600">{{ $task->description }}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-2 grid grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-600">Status:</span>
                                            <span class="font-semibold">{{ ucfirst($task->status) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Priority:</span>
                                            <span class="font-semibold">{{ ucfirst($task->priority) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Due:</span>
                                            <span class="font-semibold">{{ $task->due_date->format('Y-m-d') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>