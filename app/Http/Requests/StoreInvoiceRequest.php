<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
        return [
            'invoice_number' => 'required|string',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'section_id' => 'required|exists:sections,id',
            'amount_collection' => 'required|numeric',
            'amount_commision' => 'required|numeric',
            'discount' => 'required|numeric',
            'note' => 'nullable|string',
            'file_name' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
    
        ];
    }



    public function messages()
    {
        return [
            'invoice_number.required' => trans('validation.required'),
            'invoice_number.string' => trans('validation.string'),
            'invoice_date.required' => trans('validation.required'),
            'amount_collection.numeric' => trans('validation.numeric'),
            'due_date.required' => trans('validation.required'),
            'discount.required' => trans('validation.required'),
            'discount.numeric' => trans('validation.numeric'),

        ];
    }
}
