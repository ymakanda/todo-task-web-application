<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Create Issue' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('store-issues') }}" class="mt-6 space-y-6" >
                        @csrf
                        
                        <div>
                            
                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="body" value="body" class="mt-2 mb-2" />
                            <x-textarea-input id="body" name="body" class="mt-1 block w-full">{{ old('body') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('body')" />
                        </div>
                        
                        <div class="flex items-center gap-4 mt-2 mb-2">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>