<?php

declare(strict_types=1);

namespace Tourze\Arrayable;

/**
 * @template TKey of array-key
 * @template TValue
 */
interface AdminArrayInterface
{
    /**
     * 返回后台接口数组数据
     *
     * @return array<TKey, TValue>
     */
    public function retrieveAdminArray(): array;
}
