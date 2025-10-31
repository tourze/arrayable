<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Tests\Event;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\OrderContracts\Event\CheckOrderRefundableEvent;

/**
 * @internal
 */
#[CoversClass(CheckOrderRefundableEvent::class)]
class CheckOrderRefundableEventTest extends TestCase
{
    public function testCreateEvent(): void
    {
        $event = new CheckOrderRefundableEvent();

        self::assertSame('', $event->getOrderId());
        self::assertSame([], $event->getOrderProducts());
        self::assertTrue($event->getCanRefund());
    }

    public function testSetAndGetOrderId(): void
    {
        $event = new CheckOrderRefundableEvent();
        $orderId = 'test-order-id';

        $event->setOrderId($orderId);

        self::assertSame($orderId, $event->getOrderId());
    }

    public function testSetAndGetOrderProducts(): void
    {
        $event = new CheckOrderRefundableEvent();
        $orderProducts = [
            'product-1' => ['id' => 'product-1', 'quantity' => 2],
            'product-2' => ['id' => 'product-2', 'quantity' => 1],
        ];

        $event->setOrderProducts($orderProducts);

        self::assertSame($orderProducts, $event->getOrderProducts());
    }

    public function testSetAndGetCanRefund(): void
    {
        $event = new CheckOrderRefundableEvent();

        // 测试默认值
        self::assertTrue($event->getCanRefund());

        // 测试设置为false
        $event->setCanRefund(false);
        self::assertFalse($event->getCanRefund());

        // 测试设置为true
        $event->setCanRefund(true);
        self::assertTrue($event->getCanRefund());
    }
}
