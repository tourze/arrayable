<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Event;

/**
 * 检查订单是否可发起售后的事件.
 */
class CheckOrderRefundableEvent
{
    private string $orderId = '';

    /** @var array<string, array{id: string, quantity: int}> */
    private array $orderProducts = [];

    private bool $canRefund = true;

    public function __construct()
    {
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return array<string, array{id: string, quantity: int}>
     */
    public function getOrderProducts(): array
    {
        return $this->orderProducts;
    }

    /**
     * @param array<string, array{id: string, quantity: int}> $orderProducts
     */
    public function setOrderProducts(array $orderProducts): void
    {
        $this->orderProducts = $orderProducts;
    }

    public function getCanRefund(): bool
    {
        return $this->canRefund;
    }

    public function setCanRefund(bool $canRefund): void
    {
        $this->canRefund = $canRefund;
    }
}
