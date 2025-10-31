<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Event;

/**
 * 获取订单商品列表的事件.
 */
class GetOrderProductsEvent
{
    private string $orderReferenceNumber = '';

    /** @var array<string> */
    private array $productIds = [];

    private bool $success = false;

    private string $errorMessage = '';

    public function __construct()
    {
    }

    public function getOrderReferenceNumber(): string
    {
        return $this->orderReferenceNumber;
    }

    public function setOrderReferenceNumber(string $orderReferenceNumber): void
    {
        $this->orderReferenceNumber = $orderReferenceNumber;
    }

    /**
     * @return array<string>
     */
    public function getProductIds(): array
    {
        return $this->productIds;
    }

    /**
     * @param array<string> $productIds
     */
    public function setProductIds(array $productIds): void
    {
        $this->productIds = $productIds;
        $this->success = true;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
        $this->success = false;
    }
}
