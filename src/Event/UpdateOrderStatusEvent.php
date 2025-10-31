<?php

declare(strict_types=1);

namespace Tourze\OrderContracts\Event;

/**
 * 更新订单状态的事件.
 */
class UpdateOrderStatusEvent
{
    private string $orderReferenceNumber = '';

    private string $newStatus = '';

    private string $reason = '';

    private bool $success = false;

    private string $errorMessage = '';

    /** @var array<string, mixed> */
    private array $metadata = [];

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

    public function getNewStatus(): string
    {
        return $this->newStatus;
    }

    public function setNewStatus(string $newStatus): void
    {
        $this->newStatus = $newStatus;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function setReason(string $reason): void
    {
        $this->reason = $reason;
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
    }

    /**
     * @return array<string, mixed>
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array<string, mixed> $metadata
     */
    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }

    /**
     * 添加元数据.
     */
    public function addMetadata(string $key, mixed $value): void
    {
        $this->metadata[$key] = $value;
    }
}
