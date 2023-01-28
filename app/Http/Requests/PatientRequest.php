<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
        if ($this->method()=='POST') {
            return [
                'firstName' => 'required',
                'middleName' => 'nullable',
                'lastName' => 'required',
                'extensionName' => 'nullable',
                'address' => 'required',
                'email' => 'required|email|unique:patients,email',
                'contactNumber' => 'required',
                'dateOfBirth' => 'required',
            ];
        }else{
            return [
                'firstName' => 'required',
                'middleName' => 'nullable',
                'lastName' => 'required',
                'extensionName' => 'nullable',
                'address' => 'required',
                'email' => 'required|email|unique:patients,email,'.$this->route()->parameters['id'],
                'contactNumber' => 'required',
                'dateOfBirth' => 'required',
            ];
        }
        
    }

    public function attributes()
    {
        return [
            'firstName' => 'first name',
            'middleName' => 'middle name',
            'lastName' => 'last name',
            'extensionName' => 'extension name',
            'address' => 'address',
            'email' => 'email',
            'contactNumber' => 'contact number',
            'dateOfBirth' => 'date of birth',
        ];
    }
}
