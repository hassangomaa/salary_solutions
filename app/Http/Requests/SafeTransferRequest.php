<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SafeTransferRequest extends FormRequest
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
            'safe_from'=>'required|exists:safes,id',
            'safe_to'=>'required|exists:safes,id|different:safe_from',
            'ammount'=>'required'
        ];
    }
}
