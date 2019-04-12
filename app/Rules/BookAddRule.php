<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BookAddRule implements Rule
{
    private $book;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->book = $book;
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
        $bookId = $this->book->id;
        return !$this->book->bookshelves()->where('bookshelf_id', $value)->where('book_id', $bookId)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('book.add');
    }
}
