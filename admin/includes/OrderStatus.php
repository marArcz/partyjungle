<?php

declare(strict_types=1);

class OrderStatus
{
    public static int $CANCELLED = -1;
    public static int $ORDER_PLACED = 0;
    public static int $PACKED = 1;
    public static int $SHIPPED = 2;
    public static int $OUT_FOR_DELIVERY = 3;
    public static int $COMPLETED = 4;
    public static $statuses = ['Order Placed', 'Packed', 'Shipped', 'Out for delivery', 'Out of Stock Reservation','Completed'];
    public static function getStringStatus(int $status)
    {
        if ($status < 0) {
            if ($status === -1) {
                return "Cancelled";
            } else {
                return "Out of stock";
            }
        } else {
            return self::$statuses[$status];
        }
    }

    public static function getStatusList()
    {
        return self::$statuses;
    }
}
