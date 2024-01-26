<?php

namespace App\Http\Requests\TodoTask;

use Illuminate\Foundation\Http\FormRequest;

class AssignTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'todo_task_list_id' => 'required',
            'unique' => 'unique:users|unique:todo_task_lists',
        ];
    }
}
