<?php

declare(strict_types=1);

namespace Tourze\Arrayable;

/**
 * 返回API数组数据
 * 一般这个接口返回的数据，只在最外层使用和封装
 */
interface ApiArrayInterface
{
    /**
     * 从使用习惯来讲，应该叫 getApiArray 的，但是为了防止自动序列化出错，我们这里改个名
     */
    public function retrieveApiArray(): array;
}
