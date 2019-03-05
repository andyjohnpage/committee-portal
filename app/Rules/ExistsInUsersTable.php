<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class ExistsInUsersTable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return User::where('email', $value)
            ->orWhere('student_id', $value)
            ->count() === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No user with that Email or Student ID found.';
    }
}
