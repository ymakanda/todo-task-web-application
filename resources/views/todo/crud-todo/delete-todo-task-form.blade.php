<x-modal name="confirm-todo-task-deletion"  focusable>
    <form method="post" action="{{ route('delete-todo', $todo->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete this todo task?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
        {{ $todo->title }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>