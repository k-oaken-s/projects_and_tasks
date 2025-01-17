<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create New Project
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($projects->isEmpty())
                        <p class="text-gray-500">No projects found.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($projects as $project)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <h3 class="text-lg font-semibold">
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($project->description, 100) }}</p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <span class="text-sm text-gray-500">Due: {{ $project->due_date->format('Y-m-d') }}</span>
                                        <span class="px-2 py-1 text-sm rounded 
                                            @if($project->status === 'completed') bg-green-100 text-green-800
                                            @elseif($project->status === 'ongoing') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($project->status) }}
                                        </span>
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