<?php

namespace App\Http\Requests;

use App\Enums\LeaveRequestsType;
use App\Enums\RequestType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class StoreRequestRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => '|integer|',
            'type' => [new Enum(RequestType::class), 'required'],
            'description' => 'required|string',
            'from_date' => 'required',
            'to_date' => 'required',
            'leave_type' =>
                [new Enum(LeaveRequestsType::class),
                    'required_with:type,leave|
                     required_with:type,optionalLeave'],
            'from_hour' => '',
            'to_hour' => '',
            // Optional hours if leave request is hourly

            // Optional leave request data
            'min_days' => 'required_if:type,optionalLeave',
            'max_days' => 'required_with:min-days|integer',
            'interval' => 'required_with:min-days|integer',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422));
    }
}
