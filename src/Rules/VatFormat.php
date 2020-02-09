<?php

namespace Codelayer\VatValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class VatFormat implements Rule
{
    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        return app('vat-format')->isValid($value);
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return __('vat-validator::messages.vat_number');
    }
}
