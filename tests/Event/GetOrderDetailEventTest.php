<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Tests\Event;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\OrderContracts\Event\GetOrderDetailEvent;

/**
 * @internal
 */
#[CoversClass(GetOrderDetailEvent::class)]
final class GetOrderDetailEventTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $event = new GetOrderDetailEvent();

        // Test orderId
        $event->setOrderId('order-123');
        $this->assertSame('order-123', $event->getOrderId());

        // Test orderDetail
        $orderDetail = ['id' => 'order-123', 'status' => 'completed'];
        $event->setOrderDetail($orderDetail);
        $this->assertSame($orderDetail, $event->getOrderDetail());

        // Test result
        $result = ['data' => ['order' => $orderDetail]];
        $event->setResult($result);
        $this->assertSame($result, $event->getResult());

        // Test aftersalesStatus
        $aftersalesStatus = [
            'prod-123' => ['PENDING_APPROVAL', 'APPROVED'],
            'prod-456' => ['COMPLETED'],
        ];
        $event->setAftersalesStatus($aftersalesStatus);
        $this->assertSame($aftersalesStatus, $event->getAftersalesStatus());
    }

    public function testDefaultValues(): void
    {
        $event = new GetOrderDetailEvent();

        $this->assertSame('', $event->getOrderId());
        $this->assertNull($event->getOrderDetail());
        $this->assertNull($event->getResult());
        $this->assertNull($event->getAftersalesStatus());
    }
}
