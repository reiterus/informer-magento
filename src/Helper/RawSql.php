<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Reiterus\Informer\Helper;

/**
 * Class Money
 * @package Reiterus\Informer\Helper
 */
class RawSql
{
    /**
     * SQL to get the sum of all orders for the entire time the store is open
     *
     * @return string
     */
    public function getLifetime(): string
    {
        return <<<SQL
SELECT ROUND(SUM((
    IFNULL(main_table.base_total_invoiced, 0) -
    IFNULL(main_table.base_tax_invoiced, 0) -
    IFNULL(main_table.base_shipping_invoiced, 0) -
    (
        IFNULL(main_table.base_total_refunded, 0) -
        IFNULL(main_table.base_tax_refunded, 0) -
        IFNULL(main_table.base_shipping_refunded, 0))
) * main_table.base_to_global_rate),2) AS `lifetime`
FROM `sales_order` AS `main_table`
WHERE (main_table.status NOT IN('canceled'))
  AND (main_table.state NOT IN('new', 'pending_payment'))
;
SQL;
    }

    /**
     * SQL for calculating the average check
     *
     * @return string
     */
    public function getAverage(): string
    {
        return <<<SQL
SELECT ROUND(AVG((
    IFNULL(main_table.base_total_invoiced, 0) -
    IFNULL(main_table.base_tax_invoiced, 0) -
    IFNULL(main_table.base_shipping_invoiced, 0) -
    (
        IFNULL(main_table.base_total_refunded, 0) -
        IFNULL(main_table.base_tax_refunded, 0) -
        IFNULL(main_table.base_shipping_refunded, 0)
    )
) * main_table.base_to_global_rate),2) AS `average`
FROM `sales_order` AS `main_table`
WHERE (main_table.status NOT IN('canceled'))
AND (main_table.state NOT IN('new', 'pending_payment'))
;
SQL;

    }
}
