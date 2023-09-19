<?php

namespace App\Http\Requests\Borrowing;

use Illuminate\Foundation\Http\FormRequest;

class BorrowingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_id'=>'required',
            'other_employee_id'=>'nullable|exists:employees,id,deleted_at,NULL',
            'start_month'=>'required|date',
            'end_month'=>'required|date|after_or_equal:start_month',
            'percentage_check'=>'nullable',
            'percentage'=>"required_if:percentage_check,1"
        ];
    }
}
