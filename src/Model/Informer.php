<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Reiterus\Informer\Model;

use Magento\Framework\DataObject;
use Reiterus\Informer\Helper\Query;
use Reiterus\Informer\Api\Data\BaseInfoInterface;
use Reiterus\Informer\Api\InformerInterface;

/**
 * Class Informer
 * @package Reiterus\Informer\Model
 */
class Informer extends DataObject implements InformerInterface
{
    protected Query $query;
    protected BaseInfoFactory $baseInfoFactory;

    /**
     * @param Query $query
     * @param BaseInfoFactory $baseInfoFactory
     * @param array $data
     */
    public function __construct(
        Query $query,
        BaseInfoFactory $baseInfoFactory,
        array           $data = []
    )
    {
        $this->query = $query;
        $this->baseInfoFactory = $baseInfoFactory;
        parent::__construct($data);
    }

    /**
     * Minimal base information
     *
     * @return BaseInfoInterface
     */
    public function getBaseInfo(): BaseInfoInterface
    {
        return $this->baseInfoFactory->create();
    }

    /**
     * Get detailed information you need
     *
     * @return array
     */
    public function getDetailInfo(): array
    {
        $data = $this->getData(self::DETAIL_INFO);

        $mustHave = [
            'lifetime_sales' => $this->query->getLifetimeSales(),
            'average_order' => $this->query->getAverageOrder(),
            'orders_number' => $this->query->getCountOrders(),
            'customers_number' => $this->query->getCountCustomers(),
            'admins_number' => $this->query->getCountAdmins(),
        ];

        $data = array_merge($mustHave, $data);

        return [$data];
    }

    /**
     * Set detailed information you need
     *
     * @param array $value
     *
     * @return void
     */
    public function setDetailInfo(array $value)
    {
        $this->setData(self::DETAIL_INFO, $value);
    }
}
