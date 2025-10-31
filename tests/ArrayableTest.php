<?php

declare(strict_types=1);

namespace Tourze\Arrayable\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\Arrayable\Arrayable;

/**
 * @internal
 */
#[CoversClass(Arrayable::class)]
final class ArrayableTest extends TestCase
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
        // 检查所有值都是字符串类型
        foreach ($result as $value) {
            $this->assertIsString($value);
        }
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('test', $result['name']);
        $this->assertEquals('2024-03-24 00:00:00', $result['created_at']);
    }
}
