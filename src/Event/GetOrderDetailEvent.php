<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Event;

class GetOrderDetailEvent
{
    private string $orderId = '';

    /** @var array<string, mixed>|null */
    private ?array $orderDetail = null;

    /** @var array<string, array<string>>|null */
    private ?array $aftersalesStatus = null;

    /** @var array<string, mixed>|null */
    private ?array $result = null;

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

    /** @return array<string, mixed>|null */
    public function getOrderDetail(): ?array
    {
        return $this->orderDetail;
    }

    /** @param array<string, mixed> $orderDetail */
    public function setOrderDetail(array $orderDetail): void
    {
        $this->orderDetail = $orderDetail;
    }

    /** @return array<string, array<string>>|null */
    public function getAftersalesStatus(): ?array
    {
        return $this->aftersalesStatus;
    }

    /** @param array<string, array<string>> $aftersalesStatus */
    public function setAftersalesStatus(array $aftersalesStatus): void
    {
        $this->aftersalesStatus = $aftersalesStatus;
    }

    /** @return array<string, mixed>|null */
    public function getResult(): ?array
    {
        return $this->result;
    }

    /** @param array<string, mixed> $result */
    public function setResult(array $result): void
    {
        $this->result = $result;
    }
}
