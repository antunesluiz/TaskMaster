<?php

namespace App\Http\Requests\Task;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge($this->commonRules(), $this->methodSpecificRules());
    }

    /**
     * Define the common validation rules.
     *
     * @return array
     */
    private function commonRules(): array
    {
        return [
            'description' => 'nullable|string',
            'status' => 'in:pending,completed,in_progress',
            'created_at' => 'sometimes|date',
            'updated_at' => 'sometimes|date',
        ];
    }

    /**
     * Define the validation rules specific to the request method.
     *
     * @return array
     */
    private function methodSpecificRules(): array
    {
        if ($this->isMethod('post')) {
            return $this->storeRules();
        } elseif ($this->isMethod('patch')) {
            return $this->updateRules();
        }

        return [];
    }

    /**
     * Define the validation rules for the store method.
     *
     * @return array
     */
    private function storeRules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:tasks',
        ];
    }

    /**
     * Define the validation rules for the update method.
     *
     * @return array
     */
    private function updateRules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks')->ignore($this->route('task')),
            ],
        ];
    }
}
