<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Reiterus\Informer\Model;

use Magento\Framework\DataObject;
use Reiterus\Informer\Api\Data\BaseInfoInterface;
use Reiterus\Informer\Api\InformerInterface;

/**
 * Class Informer
 * @package Reiterus\Informer\Model
 */
class Informer extends DataObject implements InformerInterface
{
    protected BaseInfoFactory $baseInfoFactory;

    /**
     * @param BaseInfoFactory $baseInfoFactory
     * @param array $data
     */
    public function __construct(
        BaseInfoFactory $baseInfoFactory,
        array           $data = []
    )
    {
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
        return [
            $this->getData(self::DETAIL_INFO)
        ];
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
