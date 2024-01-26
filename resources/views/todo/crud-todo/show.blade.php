<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Show' }} - {{ $todoTask->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Title' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $todoTask->title }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Description' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $todoTask->description }}
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $todoTask->description }}
                        </p>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Created At' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $todoTask->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ 'Updated At' }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $todoTask->updated_at->diffForHumans() }}
                        </p>
                    </div>
                    <a href="{{ route('all-todo-task-list') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">BACK</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>