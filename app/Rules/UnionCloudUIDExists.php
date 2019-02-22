<?php

namespace App\Rules;

use App\Packages\ControlDB\Models\Student;
use App\Packages\UnionCloud\UnionCloudInterface;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Twigger\UnionCloud\API\UnionCloud;

class UnionCloudUIDExists implements Rule
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
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $unionCloud = app()->make('Twigger\UnionCloud\API\UnionCloud');
        try {
            $res = $unionCloud->users()->getByUID($value)->get()->toArray();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}