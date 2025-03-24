# Arrayable Interface

A collection of interfaces for converting objects to arrays in different contexts.

一组用于在不同场景下将对象转换为数组的接口集合。

## Installation

```bash
composer require tourze/arrayable
```

## Interfaces

### Arrayable

The base interface for converting objects to arrays.

将对象转换为数组的基础接口。

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

用于将对象转换为后台管理面板使用的数组的接口。

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

用于将对象转换为 API 响应数组的接口。

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

用于将对象转换为简单一维数组的接口。

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
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
    }

    public function retrieveAdminArray(): array
    {
        return [
            'id' => 1,
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
                'id' => 1,
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
            'id' => 1,
            'name' => 'John Doe'
        ];
    }
}
```

## License

MIT
