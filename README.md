# Arrayable Interface

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![PHP Version](https://img.shields.io/packagist/php-v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![License](https://img.shields.io/packagist/l/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![Build Status](https://img.shields.io/github/actions/workflow/status/tourze/php-monorepo/ci.yml?style=flat-square)](https://github.com/tourze/php-monorepo/actions)
[![Code Coverage](https://img.shields.io/codecov/c/github/tourze/php-monorepo?style=flat-square)](https://codecov.io/gh/tourze/php-monorepo)

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
     * 返回后台接口数组数据
     */
    public function retrieveAdminArray(): array;
}
```

### ApiArrayInterface

Interface for converting objects to arrays specifically for API responses. This interface is typically used for top-level data wrapping and encapsulation.

```php
interface ApiArrayInterface
{
    /**
     * 从使用习惯来讲，应该叫 getApiArray 的，但是为了防止自动序列化出错，我们这里改个名
     */
    public function retrieveApiArray(): array;
}
```

### PlainArrayInterface

Interface for converting objects to simple one-dimensional arrays. When implementing this method, make sure not to include complex objects and try to avoid throwing exceptions.

```php
interface PlainArrayInterface
{
    /**
     * 只有一纬层级的数据，实现这个方法时，一定要注意不要加入比较复杂的对象，最好也不要抛出异常
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
            'last_login' => '2024-03-24 10:00:00',
            'admin_field' => 'admin_value' // Additional admin-specific fields
        ];
    }

    public function retrieveApiArray(): array
    {
        return [
            'code' => 0,
            'message' => 'success',
            'data' => [
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ]
        ];
    }

    public function retrievePlainArray(): array
    {
        return [
            'id' => '2',      // Convert to string for plain array
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
    }
}
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
