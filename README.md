# Validate the format of EU VAT identification numbers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codelayer/laravel-vat-validator.svg?style=flat-square)](https://packagist.org/packages/codelayer/laravel-vat-validator)

This package can be used to validate EU VAT identification numbers such as `DE123456789`.

You can install the package using composer:

```bash
composer require codelayer/laravel-vat-validator
```

### Translations

If you wish to customize the package's translation, you can publish the translation files:

```bash
php artisan vendor:publish --provider="Codelayer\VatValidator\VatValidatorServiceProvider"
```

## Usage

Simply use the `VatFormat` rule inside your rules array, e.g. in a form request:

```php
use Codelayer\VatValidator\Rules\VatFormat;

public function rules()
{
    return [
        'vat_number' => ['required', new VatFormat()],
    ];
}
```

## About Us

[codelayer](https://codelayer.de) is a web development agency based in Karlsruhe, Germany. This package was developed for use in our product [likvi](https://likvi.de).

## License

The MIT License (MIT).
