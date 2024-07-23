<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            //
        'id' => 'required|integer|exists:employees,id',
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'birthdate' => 'required|date',
        'gender' => 'required|string|max:10',
        'phone_number' => 'nullable|string|max:20',
        'position' => 'required|string|max:255',
        'department_id' => 'required|integer|exists:departments,id',
        'sss_number' => 'nullable|string|max:20',
        'philhealth' => 'nullable|string|max:20',
        'tin_number' => 'nullable|string|max:20',
        'monthly_pay' => 'nullable|numeric',
        'allowance' => 'nullable|numeric',
        'basic_pay' => 'nullable|numeric',
        'bi_monthly' => 'nullable|numeric',
        'daily_rate' => 'nullable|numeric',

        ];
    }
}
