# Arrayable Interface

[![Latest Version](https://img.shields.io/packagist/v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![PHP Version](https://img.shields.io/packagist/php-v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![License](https://img.shields.io/packagist/l/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)

A collection of interfaces for converting objects to arrays in different contexts.

## Features

- Provides a standardized way to convert objects to arrays
- Includes specialized interfaces for different use cases (Admin, API, Plain)
- Simple implementation with no dependencies
- Fully typed with PHP 8.1+ generics support

## Installation

```bash
composer require tourze/arrayable
```

## Interfaces

### Arrayable

The base interface for converting objects to arrays.

```php
interface Arrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array;
}
```

### AdminArrayInterface

Interface for converting objects to arrays specifically for admin panel usage.

```php
interface AdminArrayInterface
{
    /**
     * Return array data for admin interface
     */
    public function retrieveAdminArray(): array;
}
```

### ApiArrayInterface

Interface for converting objects to arrays specifically for API responses.

```php
interface ApiArrayInterface
{
    /**
     * Return array data for API response
     */
    public function retrieveApiArray(): array;
}
```

### PlainArrayInterface

Interface for converting objects to simple one-dimensional arrays.

```php
interface PlainArrayInterface
{
    /**
     * Return a simple one-dimensional array
     */
    public function retrievePlainArray(): array;
}
```

## Usage

```php
use Tourze\Arrayable\Arrayable;
use Tourze\Arrayable\AdminArrayInterface;
use Tourze\Arrayable\ApiArrayInterface;
use Tourze\Arrayable\PlainArrayInterface;

class User implements Arrayable, AdminArrayInterface, ApiArrayInterface, PlainArrayInterface
{
    public function toArray(): array
    {
        return [
            'id' => 2,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
    }

    public function retrieveAdminArray(): array
    {
        return [
            'id' => 2,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'created_at' => '2024-03-24',
            'last_login' => '2024-03-24 10:00:00'
        ];
    }

    public function retrieveApiArray(): array
    {
        return [
            'data' => [
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ],
            'meta' => [
                'version' => '1.0'
            ]
        ];
    }

    public function retrievePlainArray(): array
    {
        return [
            'id' => 2,
            'name' => 'John Doe'
        ];
    }
}
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
