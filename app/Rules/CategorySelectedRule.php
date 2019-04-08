<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CategorySelectedRule implements Rule
{
    private $bookshelf;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($bookshelf)
    {
        $this->bookshelf = $bookshelf;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !$this->bookshelf->categories()->where('id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('bookshelf.category.selected');
    }
}
