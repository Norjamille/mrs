<?php

namespace App\Http\Requests;

use App\Models\Pregnancy;
use Illuminate\Foundation\Http\FormRequest;

class PatientPregnancyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'firstCheckUpAt' => 'required',
                'months' => 'required|numeric|min:0',
                'status' => 'required|in:'.implode(', ', array_keys(Pregnancy::STATUSES)),
                'noOfBabies' => 'numeric|min:1',
                'refererUrl' => 'required',
                'patientId' => 'required',
            ];
        }
    }

    public function attributes()
    {
        return [
            'firstCheckUpAt' => 'first check up date',
            'months' => 'months',
            'status' => 'status',
            'noOfBabies' => 'no. of babies',
        ];
    }
}
