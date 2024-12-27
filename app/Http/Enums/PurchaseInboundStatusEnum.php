<?php

namespace App\Http\Enums;

class PurchaseInboundStatusEnum
{
    const PENDING = 0;
    const APPROVED = 1;
    const CANCELLED = 2;

    public static function getAllStatus(): array
    {
        $reflection = new \ReflectionClass(self::class);
        return $reflection->getConstants();
    }

    public static function isPending($status): bool
    {
        return $status === self::PENDING;
    }

    public static function isApproved($status): bool
    {
        return $status === self::APPROVED;
    }

    public static function isCancelled($status): bool
    {
        return $status === self::CANCELLED;
    }
}
