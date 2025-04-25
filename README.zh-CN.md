# Arrayable 接口

[![最新版本](https://img.shields.io/packagist/v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![PHP 版本](https://img.shields.io/packagist/php-v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![总下载量](https://img.shields.io/packagist/dt/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![许可证](https://img.shields.io/packagist/l/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)

一组用于在不同场景下将对象转换为数组的接口集合。

## 特性

- 提供将对象转换为数组的标准化方式
- 包含针对不同使用场景的专用接口（管理后台、API、简单数组）
- 简单实现，无依赖
- 完全支持 PHP 8.1+ 泛型类型

## 安装

```bash
composer require tourze/arrayable
```

## 接口

### Arrayable

将对象转换为数组的基础接口。

```php
interface Arrayable
{
    /**
     * 获取实例的数组表示
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array;
}
```

### AdminArrayInterface

用于将对象转换为后台管理面板使用的数组的接口。

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

用于将对象转换为 API 响应数组的接口。

```php
interface ApiArrayInterface
{
    /**
     * 返回API数组数据
     */
    public function retrieveApiArray(): array;
}
```

### PlainArrayInterface

用于将对象转换为简单一维数组的接口。

```php
interface PlainArrayInterface
{
    /**
     * 返回简单的一维数组
     */
    public function retrievePlainArray(): array;
}
```

## 使用示例

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

## 贡献

欢迎贡献！请随时提交 Pull Request。

## 许可证

MIT 许可证。详情请查看 [许可证文件](LICENSE)。
