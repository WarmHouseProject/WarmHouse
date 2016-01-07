<?php

class StockStatus
{
    const ACTIVE   = 0;
    const INACTIVE = 1;

    const DEFAULT_STOCK_STATUS = self::ACTIVE;

    static function getStockStatuses()
    {
        return [
            self::ACTIVE ,
            self::INACTIVE,
        ];
    }

    static function getStockStatusesText()
    {
        return [
            self::ACTIVE   => 'Действующее',
            self::INACTIVE => "Завершённое",
        ];
    }
}