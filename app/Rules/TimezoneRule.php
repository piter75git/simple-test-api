<?php

declare(strict_types = 1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimezoneRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return app('timezone')->isValid($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.custom.timezone.invalid');
    }
}
