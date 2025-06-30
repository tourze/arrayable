<?php

declare(strict_types=1);

namespace Tourze\Arrayable\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\Arrayable\AdminArrayInterface;
use Tourze\Arrayable\ApiArrayInterface;
use Tourze\Arrayable\Arrayable;
use Tourze\Arrayable\PlainArrayInterface;

class TestModel implements Arrayable, AdminArrayInterface, ApiArrayInterface, PlainArrayInterface
{
    private array $data = [
        'id' => 1,
        'name' => 'test',
        'created_at' => '2024-03-24 00:00:00'
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
            'data' => $this->data
        ];
    }

    public function retrievePlainArray(): array
    {
        return array_map('strval', $this->data);
    }
}

class ArrayableTest extends TestCase
{
    private TestModel $model;

    protected function setUp(): void
    {
        $this->model = new TestModel();
    }

    public function testToArray(): void
    {
        $result = $this->model->toArray();
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('created_at', $result);
    }

    public function testRetrieveAdminArray(): void
    {
        $result = $this->model->retrieveAdminArray();
        $this->assertArrayHasKey('admin_field', $result);
        $this->assertEquals('admin_value', $result['admin_field']);
    }

    public function testRetrieveApiArray(): void
    {
        $result = $this->model->retrieveApiArray();
        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('data', $result);
        $this->assertEquals(0, $result['code']);
        $this->assertEquals('success', $result['message']);
    }

    public function testRetrievePlainArray(): void
    {
        $result = $this->model->retrievePlainArray();
        $this->assertContainsOnly('string', $result);
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('test', $result['name']);
        $this->assertEquals('2024-03-24 00:00:00', $result['created_at']);
    }
}
