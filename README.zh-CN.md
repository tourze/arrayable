# Arrayable 接口

[English](README.md) | [中文](README.zh-CN.md)

[![最新版本](https://img.shields.io/packagist/v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![PHP 版本](https://img.shields.io/packagist/php-v/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![总下载量](https://img.shields.io/packagist/dt/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![License](https://img.shields.io/packagist/l/tourze/arrayable.svg?style=flat-square)](https://packagist.org/packages/tourze/arrayable)
[![Build Status](https://img.shields.io/github/actions/workflow/status/tourze/php-monorepo/ci.yml?style=flat-square)](https://github.com/tourze/php-monorepo/actions)
[![Code Coverage](https://img.shields.io/codecov/c/github/tourze/php-monorepo?style=flat-square)](https://codecov.io/gh/tourze/php-monorepo)

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

用于将对象转换为 API 响应数组的接口。一般这个接口返回的数据，只在最外层使用和封装。

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

用于将对象转换为简单一维数组的接口。实现这个方法时，一定要注意不要加入比较复杂的对象，最好也不要抛出异常。

```php
interface PlainArrayInterface
{
    /**
     * 只有一纬层级的数据，实现这个方法时，一定要注意不要加入比较复杂的对象，最好也不要抛出异常
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
            'last_login' => '2024-03-24 10:00:00',
            'admin_field' => 'admin_value' // 后台管理专用字段
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
            'id' => '2',      // 为简单数组转换为字符串
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
    }
}
```

## 贡献

欢迎贡献！请随时提交 Pull Request。

## 许可证

MIT 许可证。详情请查看 [许可证文件](LICENSE)。
