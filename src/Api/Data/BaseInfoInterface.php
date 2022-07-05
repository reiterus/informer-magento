<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Reiterus\Informer\Api\Data;

/**
 * Interface BaseInfoInterface
 * @package Reiterus\Informer\Api\Data
 */
interface BaseInfoInterface
{
    /**
     * Get Magento engine version
     *
     * @return string
     */
    public function getVersion(): string;

    /**
     * Get store locale
     *
     * @return string
     */
    public function getLocale(): string;

    /**
     * Get store timezone
     *
     * @return string
     */
    public function getTimezone(): string;

    /**
     * Get store currency
     *
     * @return string
     */
    public function getCurrency(): string;
}
