<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($todoTask) ? 'Edit' : 'Create' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ isset($myTodoTask) ? route('update-my-todo', $myTodoTask->id) : route('store-my-todo') }}" class="mt-6 space-y-6" >
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($todoTask)
                            @method('get')
                        @endisset
                
                        <div>
                            
                        <x-input-label for="todo_task_list_id" value="Todo Task List" />
                            <x-input-select :options="$allTodoTask" id="todo_task_list_id" name="todo_task_list_id" :value="$todoTask->todo_task_list_id ?? old('todo_task_list_id')" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('todo_task_list_id')" />
                        </div>

                        <x-input-label for="user_id" value="User List" />
                            <x-input-select :options="$allUsers" id="user_id" name="user_id"  class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>