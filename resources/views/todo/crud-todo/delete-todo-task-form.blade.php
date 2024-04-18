<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ 'Delete' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="post" action="{{ route('destroy-todo', $todo->id) }}" class="p-6">
                    @csrf
                    @isset($todo)
                        @method('delete')
                    @endisset

                    <p class="mb-5 flex justify-center">Are you sure you want to delete this user account?    <strong class="ml-5">{{ $todo->title }} </strong></p>  
                    <div class="mt-6 flex justify-center">
                        <a href="{{ route('all-todo-task-list') }}" class=" items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Cancel</a>
                        <x-danger-button class="ms-3">
                            {{ __('Delete Task') }}
                        </x-danger-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-modal>