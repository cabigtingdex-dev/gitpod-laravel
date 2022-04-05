<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BatchUpdateBookRequest extends FormRequest
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
            'bookIds' => ['array'],
            'booksData.*.title' => ['string', 'max:50'],
            'booksData.*.author' => ['string', 'max:50'],
            'booksData.*.category' => ['string', 'max:50'],
            'booksData.*.description' => ['string', 'max:50'],
            'booksData.*.publishing_house' => ['string', 'max:50'],
            'booksData.*.publishing_date' => ['date']
        ];
    }
}
