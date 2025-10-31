<?php

declare(strict_types=1);

namespace Tourze\Arrayable\Tests;

use Tourze\Arrayable\AdminArrayInterface;
use Tourze\Arrayable\ApiArrayInterface;
use Tourze\Arrayable\Arrayable;
use Tourze\Arrayable\PlainArrayInterface;

/**
 * @implements Arrayable<string, mixed>
 * @implements AdminArrayInterface<string, mixed>
 * @implements ApiArrayInterface<string, mixed>
 * @implements PlainArrayInterface<string, string>
 */
class TestModel implements Arrayable, AdminArrayInterface, ApiArrayInterface, PlainArrayInterface
{
    /** @var array<string, int|string> */
    private array $data = [
        'id' => 1,
        'name' => 'test',
        'created_at' => '2024-03-24 00:00:00',
    ];

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @return array<string, mixed>
     */
    public function retrieveAdminArray(): array
    {
        return array_merge($this->data, ['admin_field' => 'admin_value']);
    }

    /**
     * @return array<string, mixed>
     */
    public function retrieveApiArray(): array
    {
        return [
            'code' => 0,
            'message' => 'success',
            'data' => $this->data,
        ];
    }

    /**
     * @return array<string, string>
     */
    public function retrievePlainArray(): array
    {
        return array_map('strval', $this->data);
    }
}
