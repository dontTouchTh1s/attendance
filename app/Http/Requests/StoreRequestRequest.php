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
            'employee_id' => 'required|integer|',
            'type' => [new Enum(RequestType::class), 'required'],
            'description' => 'required|string',
            'leave_type' =>
                [new Enum(LeaveRequestsType::class),
                    'required_with:type,leave
                    |required_with:type,optionalLeave'],
            'dates' => 'required_unless:type,optionalLeave|json',
            'from_hour' => 'required_if:type,overtime|date',
            'to_hour' => 'required_with:from-hour|date',
            'min_days' => 'required_if:type,optionalLeave',
            'max_days' => 'required_with:min-days|integer',
            'from_date' => 'required_with:min-days|date',
            'to_date' => 'required_with:min-days|date',
            'interval' => 'required_with:min-days|integer',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'validation error',
            'errors' => $validator->errors()
        ], 422));
    }
}
