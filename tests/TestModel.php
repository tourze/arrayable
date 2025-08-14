<?php

declare(strict_types=1);

namespace Tourze\Arrayable\Tests;

use Tourze\Arrayable\AdminArrayInterface;
use Tourze\Arrayable\ApiArrayInterface;
use Tourze\Arrayable\Arrayable;
use Tourze\Arrayable\PlainArrayInterface;

class TestModel implements Arrayable, AdminArrayInterface, ApiArrayInterface, PlainArrayInterface
{
    private array $data = [
        'id' => 1,
        'name' => 'test',
        'created_at' => '2024-03-24 00:00:00',
    ];

    public function toArray(): array
    {
        return $this->data;
    }

    public function retrieveAdminArray(): array
    {
        return array_merge($this->data, ['admin_field' => 'admin_value']);
    }

    public function retrieveApiArray(): array
    {
        return [
            'code' => 0,
            'message' => 'success',
            'data' => $this->data,
        ];
    }

    public function retrievePlainArray(): array
    {
        return array_map('strval', $this->data);
    }
}
