<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'person_name' => 'required|string',
            'name' => 'required|string',
            'address1' => 'nullable|string',
            'address2' => 'nullable|string',
            'address3' => 'nullable|string',

            'n_t_n_number' => 'nullable|string',
            'g_s_t_number' => 'nullable|string',
            'remarks' => 'nullable|string',
            
            'product_id' => 'nullable|numeric|exists:products,id',
            
            'purchase_amount' => 'nullable|numeric',
            
            'landline_number' => 'nullable|string',
            'srs_code' => 'nullable|string',

            'subscription_type' => 'required|string|in:prepaid,postpaid',

            'courier' => 'required|string|in:byhand,ums,email',
            'status' => 'required|string|in:active,inactive,suspended,demo',
            
            'postal_name' => 'required|string',
            'postal_address1' => 'nullable|string',
            'postal_address2' => 'nullable|string',
            'postal_address3' => 'nullable|string',

            'nick_name' => 'required|string',
            'nick_address1' => 'nullable|string',
            'nick_address2' => 'nullable|string',
            'nick_address3' => 'nullable|string',
            
            'country_id' => 'nullable|numeric|exists:countries,id',
        ];
    }
}
