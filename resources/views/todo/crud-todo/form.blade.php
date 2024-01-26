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
                    <form method="post" action="{{ isset($todoTask) ? route('update-todo', $todoTask->id) : route('store-todo') }}" class="mt-6 space-y-6" >
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($todoTask)
                            @method('put')
                        @endisset
                
                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="$todoTask->title ?? old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="description" />
                            <x-textarea-input id="description" name="description" class="mt-1 block w-full" required autofocus>{{ $todoTask->description ?? old('description') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="comments" value="comments" />
                            <x-textarea-input id="comments" name="comments" class="mt-1 block w-full" required autofocus>{{ $todoTask->comments ?? old('comments') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('comments')" />
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