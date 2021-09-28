<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
         return [
            'todo' => 'required|min:2',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'task.required' => 'Todo field is required!',
            'status_id.required' => 'Status field is required!',
        ];
    }
}
