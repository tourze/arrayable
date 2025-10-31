<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Tests\Event;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\OrderContracts\Event\UpdateOrderStatusEvent;

/**
 * @internal
 */
#[CoversClass(UpdateOrderStatusEvent::class)]
class UpdateOrderStatusEventTest extends TestCase
{
    public function testCreateEvent(): void
    {
        $event = new UpdateOrderStatusEvent();

        self::assertSame('', $event->getOrderReferenceNumber());
        self::assertSame('', $event->getNewStatus());
        self::assertSame('', $event->getReason());
        self::assertFalse($event->isSuccess());
        self::assertSame('', $event->getErrorMessage());
        self::assertSame([], $event->getMetadata());
    }

    public function testSetAndGetOrderReferenceNumber(): void
    {
        $event = new UpdateOrderStatusEvent();
        $orderReferenceNumber = 'test-order-ref-456';

        $event->setOrderReferenceNumber($orderReferenceNumber);

        self::assertSame($orderReferenceNumber, $event->getOrderReferenceNumber());
    }

    public function testSetAndGetNewStatus(): void
    {
        $event = new UpdateOrderStatusEvent();
        $newStatus = 'shipped';

        $event->setNewStatus($newStatus);

        self::assertSame($newStatus, $event->getNewStatus());
    }

    public function testSetAndGetReason(): void
    {
        $event = new UpdateOrderStatusEvent();
        $reason = '商品已发货';

        $event->setReason($reason);

        self::assertSame($reason, $event->getReason());
    }

    public function testSetAndGetSuccess(): void
    {
        $event = new UpdateOrderStatusEvent();

        // 测试默认值
        self::assertFalse($event->isSuccess());

        // 测试设置为true
        $event->setSuccess(true);
        self::assertTrue($event->isSuccess());

        // 测试设置为false
        $event->setSuccess(false);
        self::assertFalse($event->isSuccess());
    }

    public function testSetAndGetErrorMessage(): void
    {
        $event = new UpdateOrderStatusEvent();
        $errorMessage = '订单状态更新失败';

        // 测试默认值
        self::assertSame('', $event->getErrorMessage());

        $event->setErrorMessage($errorMessage);

        self::assertSame($errorMessage, $event->getErrorMessage());
    }

    public function testSetAndGetMetadata(): void
    {
        $event = new UpdateOrderStatusEvent();
        $metadata = [
            'updatedBy' => 'user-123',
            'timestamp' => '2024-09-11T10:00:00Z',
            'source' => 'admin-panel',
        ];

        $event->setMetadata($metadata);

        self::assertSame($metadata, $event->getMetadata());
    }

    public function testAddMetadata(): void
    {
        $event = new UpdateOrderStatusEvent();

        // 添加第一个元数据项
        $event->addMetadata('updatedBy', 'user-456');
        self::assertSame(['updatedBy' => 'user-456'], $event->getMetadata());

        // 添加第二个元数据项
        $event->addMetadata('reason', 'customer-request');
        $expected = [
            'updatedBy' => 'user-456',
            'reason' => 'customer-request',
        ];
        self::assertSame($expected, $event->getMetadata());

        // 覆盖已存在的键
        $event->addMetadata('updatedBy', 'user-789');
        $expected['updatedBy'] = 'user-789';
        self::assertSame($expected, $event->getMetadata());
    }

    public function testAddMetadataWithVariousTypes(): void
    {
        $event = new UpdateOrderStatusEvent();

        $event->addMetadata('stringValue', 'test');
        $event->addMetadata('intValue', 42);
        $event->addMetadata('floatValue', 3.14);
        $event->addMetadata('boolValue', true);
        $event->addMetadata('arrayValue', ['item1', 'item2']);

        $expected = [
            'stringValue' => 'test',
            'intValue' => 42,
            'floatValue' => 3.14,
            'boolValue' => true,
            'arrayValue' => ['item1', 'item2'],
        ];

        self::assertSame($expected, $event->getMetadata());
    }

    public function testCompleteWorkflow(): void
    {
        $event = new UpdateOrderStatusEvent();

        // 设置基本信息
        $event->setOrderReferenceNumber('ORD-2024-001');
        $event->setNewStatus('processing');
        $event->setReason('订单已确认，开始处理');

        // 添加元数据
        $event->addMetadata('updatedBy', 'system');
        $event->addMetadata('timestamp', '2024-09-11T12:00:00Z');

        // 设置成功状态
        $event->setSuccess(true);

        // 验证所有属性
        self::assertSame('ORD-2024-001', $event->getOrderReferenceNumber());
        self::assertSame('processing', $event->getNewStatus());
        self::assertSame('订单已确认，开始处理', $event->getReason());
        self::assertTrue($event->isSuccess());
        self::assertSame('', $event->getErrorMessage());

        $expectedMetadata = [
            'updatedBy' => 'system',
            'timestamp' => '2024-09-11T12:00:00Z',
        ];
        self::assertSame($expectedMetadata, $event->getMetadata());
    }
}
