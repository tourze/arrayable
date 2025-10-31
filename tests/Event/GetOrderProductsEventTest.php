<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Tests\Event;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\OrderContracts\Event\GetOrderProductsEvent;

/**
 * @internal
 */
#[CoversClass(GetOrderProductsEvent::class)]
class GetOrderProductsEventTest extends TestCase
{
    public function testCreateEvent(): void
    {
        $event = new GetOrderProductsEvent();

        self::assertSame('', $event->getOrderReferenceNumber());
        self::assertSame([], $event->getProductIds());
        self::assertFalse($event->isSuccess());
        self::assertSame('', $event->getErrorMessage());
    }

    public function testSetAndGetOrderReferenceNumber(): void
    {
        $event = new GetOrderProductsEvent();
        $orderReferenceNumber = 'test-order-ref-123';

        $event->setOrderReferenceNumber($orderReferenceNumber);

        self::assertSame($orderReferenceNumber, $event->getOrderReferenceNumber());
    }

    public function testSetAndGetProductIds(): void
    {
        $event = new GetOrderProductsEvent();
        $productIds = ['product-1', 'product-2', 'product-3'];

        $event->setProductIds($productIds);

        self::assertSame($productIds, $event->getProductIds());
        self::assertTrue($event->isSuccess());
    }

    public function testSetAndGetSuccess(): void
    {
        $event = new GetOrderProductsEvent();

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
        $event = new GetOrderProductsEvent();
        $errorMessage = '订单商品获取失败';

        // 测试默认值
        self::assertSame('', $event->getErrorMessage());

        $event->setErrorMessage($errorMessage);

        self::assertSame($errorMessage, $event->getErrorMessage());
        self::assertFalse($event->isSuccess());
    }

    public function testSetProductIdsSetSuccess(): void
    {
        $event = new GetOrderProductsEvent();
        $productIds = ['product-1', 'product-2'];

        $event->setProductIds($productIds);

        self::assertTrue($event->isSuccess());
        self::assertSame($productIds, $event->getProductIds());
    }

    public function testSetErrorMessageSetFailure(): void
    {
        $event = new GetOrderProductsEvent();

        // 先设置成功状态
        $event->setSuccess(true);
        self::assertTrue($event->isSuccess());

        // 设置错误消息应该将成功状态设为false
        $event->setErrorMessage('获取商品失败');

        self::assertFalse($event->isSuccess());
        self::assertSame('获取商品失败', $event->getErrorMessage());
    }
}
