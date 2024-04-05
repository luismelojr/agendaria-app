<?php

namespace App\Http\Requests\Professionals;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'monday_starts_at' => ['nullable', 'date_format:H:i'],
            'monday_ends_at' => ['date_format:H:i', 'after:monday_starts_at', (request()->monday_starts_at) ? 'required' : 'nullable'],
            'tuesday_starts_at' => ['nullable', 'date_format:H:i'],
            'tuesday_ends_at' => ['date_format:H:i', 'after:tuesday_starts_at', (request()->tuesday_starts_at) ? 'required' : 'nullable'],
            'wednesday_starts_at' => ['nullable', 'date_format:H:i'],
            'wednesday_ends_at' => ['date_format:H:i', 'after:wednesday_starts_at', (request()->wednesday_starts_at) ? 'required' : 'nullable'],
            'thursday_starts_at' => ['nullable', 'date_format:H:i'],
            'thursday_ends_at' => ['date_format:H:i', 'after:thursday_starts_at', (request()->thursday_starts_at) ? 'required' : 'nullable'],
            'friday_starts_at' => ['nullable', 'date_format:H:i'],
            'friday_ends_at' => ['date_format:H:i', 'after:friday_starts_at', (request()->friday_starts_at) ? 'required' : 'nullable'],
            'saturday_starts_at' => ['nullable', 'date_format:H:i'],
            'saturday_ends_at' => ['date_format:H:i', 'after:saturday_starts_at', (request()->saturday_starts_at) ? 'required' : 'nullable'],
            'sunday_starts_at' => ['nullable', 'date_format:H:i'],
            'sunday_ends_at' => ['date_format:H:i', 'after:sunday_starts_at', (request()->sunday_starts_at) ? 'required' : 'nullable'],
        ];
    }
}
