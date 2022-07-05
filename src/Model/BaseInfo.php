<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Reiterus\Informer\Model;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Reiterus\Informer\Api\Data\BaseInfoInterface;

/**
 * Class BaseInfo
 * @package Reiterus\Informer\Model
 */
class BaseInfo implements BaseInfoInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @var ProductMetadataInterface
     */
    protected ProductMetadataInterface $metadata;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param ProductMetadataInterface $metadata
     */
    public function __construct(
        ScopeConfigInterface     $scopeConfig,
        ProductMetadataInterface $metadata
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->metadata = $metadata;
    }

    /**
     * Get Magento engine version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->metadata->getVersion();
    }

    /**
     * Get store locale
     *
     * @return string
     */
    public function getLocale(): string
    {
        return $this->scopeConfig->getValue(
            'general/locale/code',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get store timezone
     *
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->scopeConfig->getValue(
            'general/locale/timezone',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get store currency
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->scopeConfig->getValue(
            'currency/options/base',
            ScopeInterface::SCOPE_STORE
        );
    }
}
