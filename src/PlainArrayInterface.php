<?php

declare(strict_types=1);

namespace Tourze\Arrayable;

/**
 * 只有一纬层级的数据，实现这个方法时，一定要注意不要加入比较复杂的对象，最好也不要抛出异常
 */
/**
 * @template TKey of array-key
 * @template TValue
 */
interface PlainArrayInterface
{
    /**
     * @return array<TKey, TValue>
     */
    public function retrievePlainArray(): array;
}
