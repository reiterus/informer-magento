<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Reiterus\Informer\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\App\ResourceConnection;
use Zend_Db_Statement_Exception;

/**
 * Class Query
 * @package Reiterus\Informer\Helper
 */
class Query extends AbstractHelper
{
    /**
     * @var RawSql
     */
    protected RawSql $rawSql;

    /**
     * @var AdapterInterface
     */
    protected AdapterInterface $connection;

    /**
     * @var ResourceConnection
     */
    protected ResourceConnection $resource;

    /**
     * @param RawSql $rawSql
     * @param ResourceConnection $resource
     * @param Context $context
     */
    public function __construct(
        RawSql             $rawSql,
        ResourceConnection $resource,
        Context            $context
    )
    {
        $this->rawSql = $rawSql;
        $this->resource = $resource;
        $this->connection = $resource->getConnection();
        parent::__construct($context);
    }

    /**
     * Sum of all sales for the entire period
     *
     * @return string
     */
    public function getLifetimeSales(): string
    {
        $sql = $this->rawSql->getLifetime();

        return $this->runQuery($sql);
    }

    /**
     * Average order amount
     *
     * @return string
     */
    public function getAverageOrder(): string
    {
        $sql = $this->rawSql->getAverage();

        return $this->runQuery($sql);
    }

    /**
     * Admin counting
     *
     * @return string
     */
    public function getCountAdmins(): string
    {
        $sql = $this->getExprSql(
            'admin_user',
            'user_id',
            'main_table.is_active = 1'
        );

        return $this->runQuery($sql);
    }

    /**
     * Customer counting
     *
     * @return string
     */
    public function getCountCustomers(): string
    {
        $sql = $this->getExprSql(
            'customer_entity',
            'entity_id',
            'main_table.is_active = 1'
        );

        return $this->runQuery($sql);
    }

    /**
     * Order counting
     *
     * @return string
     */
    public function getCountOrders(): string
    {
        $sql = $this->getExprSql(
            'sales_order',
            'entity_id',
            'main_table.status is not null'
        );

        return $this->runQuery($sql);
    }

    /**
     * Get raw sql with expression
     *
     * @param string $table
     * @param string $column
     * @param string $where
     *
     * @return string
     */
    protected function getExprSql(
        string $table,
        string $column,
        string $where
    ): string
    {
        $expression = "COUNT(main_table.{$column})";

        return $this->connection->select()
            ->from(
                ['main_table' => $table],
                [new \Zend_Db_Expr($expression)])
            ->where($where)
            ->__toString();
    }

    /**
     * Run raw sql query
     *
     * @param string $sql
     *
     * @return string
     */
    protected function runQuery(string $sql): string
    {
        $result = '';

        try {
            $result = $this->connection->query($sql)->fetchColumn();
        } catch (Zend_Db_Statement_Exception $e) {
            $this->_logger->critical($e->getMessage());
        }

        return $result;
    }
}
