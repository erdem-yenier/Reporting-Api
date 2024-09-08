<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportFormRequest extends FormRequest
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
            'from_date' => 'required',
            'to_date' => 'required',
            'merchant' =>'required',
            'acquirer' =>'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'from_date.required' => 'Lütfen tarih alanı boş geçmeyiniz.',
            'to_date.required' => 'Lütfen tarih alanı boş geçmeyiniz.',
            'merchant.required' => 'Lütfen merchant alanını boş geçmeyiniz.',
            'acquirer.required' => 'Lütfen acquirer alanını boş geçmeyiniz.',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
