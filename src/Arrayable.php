<?php

declare(strict_types=1);

namespace Tourze\Arrayable;

/**
 * @template TKey of array-key
 * @template TValue
 */
interface Arrayable
{
    /**
     * 将实例转换为数组
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array;
}
