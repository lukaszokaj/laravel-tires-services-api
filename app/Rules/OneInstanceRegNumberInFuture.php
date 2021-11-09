<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Requests\UserBookRequest;
use App\Models\Swap;

class OneInstanceRegNumberInFuture implements Rule
{

    public $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->request = $request;
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
        $swap = Swap::where('registration_number', $value)
                      ->where('swap_data', '>=', date('Y-m-d H:m:s'))
                      ->first();

        if ($swap) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given registration number has already been booked.';
    }
}
