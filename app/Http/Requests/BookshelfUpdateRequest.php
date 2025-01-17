<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CategorySelectedRule;

class BookshelfUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->id === $this->bookshelf->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:191'],
            // 'categories' => ['required', 'array'],
            // 'categories.*' => ['integer', 'distinct', new CategorySelectedRule($this->bookshelf)],
        ];
    }
}
