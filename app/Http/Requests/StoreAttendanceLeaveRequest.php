<?php

namespace App\Http\Requests;

use App\Enums\AttendanceLeaveType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreAttendanceLeaveRequest extends FormRequest
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
            'type' => [new Enum(AttendanceLeaveType::class)],
            'date' => 'required',
            'employee_id' => 'integer'
        ];
    }
}