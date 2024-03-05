<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'priority' => 'nullable|string',
            'category' => 'nullable|string',
            'recurring' => 'required|boolean',
            'interval' => 'nullable|boolean',
            'archived' => 'nullable|boolean',
            'completed' => 'nullable|boolean',
            'completed_at' => 'nullable|date',
            'due_date' => 'nullable|timestamp',
        ];
    }
}
