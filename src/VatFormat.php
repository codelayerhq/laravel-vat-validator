<?php

namespace Codelayer\VatValidator;

class VatFormat
{
    /**
     * @var \Illuminate\Support\Collection
     */
    private $formats;

    /**
     * VatFormat constructor.
     */
    public function __construct()
    {
        $this->formats = collect(json_decode(file_get_contents(__DIR__ . '/../resources/formats/vat.json')));
    }

    /**
     * @param string $vatNumber
     *
     * @return bool
     */
    public function isValid($vatNumber)
    {
        $vatNumber = $this->normalize($vatNumber);

        $country = $this->country($vatNumber);

        if (!$this->formats->has($country)) {
            return false;
        }

        $rules = collect($this->formats->get($country));

        return $rules->contains(function ($rule) use ($vatNumber) {
            return preg_match($rule, $vatNumber) === 1;
        });
    }

    /**
     * @param string $vatNumber
     *
     * @return bool
     */
    public function isInvalid($vatNumber)
    {
        return !$this->isValid($vatNumber);
    }

    /**
     * Get the country code of the vat number.
     *
     * @param string $vatNumber
     *
     * @return string
     */
    public function country($vatNumber)
    {
        return $this->split($vatNumber)[0];
    }

    /**
     * Return the "number" part of the vat number.
     *
     * @param string $vatNumber
     *
     * @return string
     */
    public function number($vatNumber)
    {
        return $this->split($vatNumber)[1];
    }

    /**
     * Split the vat number into country code and number part.
     *
     * @param string $vatNumber
     *
     * @return array
     */
    public function split($vatNumber)
    {
        return [substr($vatNumber, 0, 2), substr($vatNumber, 2)];
    }

    /**
     * Normalize the vat number.
     *
     * @param string $vatNumber
     *
     * @return string
     */
    public function normalize($vatNumber)
    {
        return str_replace([' ', '-', '.', ',', '/'], '', trim($vatNumber));
    }
}
