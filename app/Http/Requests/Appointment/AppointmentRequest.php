<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'service_id' => 'required|uuid|exists:services,id',
            'client_id' => 'required|uuid|exists:clients,id',
            'user_id' => 'required|uuid|exists:users,id',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'phone' => 'required|numeric|digits:11',
            'name' => 'required|string|max:255',
        ];
    }
}
