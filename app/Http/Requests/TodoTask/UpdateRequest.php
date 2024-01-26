<?php

namespace App\Http\Requests\TodoTask;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|unique:todo_task_lists|min:3|max:250',
            'description' => 'string|min:3|max:250',
            'comments' => 'string|min:3|max:250',
        ];
    }
}
