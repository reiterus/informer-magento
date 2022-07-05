<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Reiterus\Informer\Api;

use Reiterus\Informer\Api\Data\BaseInfoInterface;

/**
 * Interface InformerInterface
 * @package Reiterus\Informer
 */
interface InformerInterface
{
    /**
     * @var string
     */
    const DETAIL_INFO = 'detail_info';

    /**
     * Minimal base information
     *
     * @return BaseInfoInterface
     */
    public function getBaseInfo(): BaseInfoInterface;

    /**
     * Get detailed information you need
     *
     * @return array
     */
    public function getDetailInfo(): array;

    /**
     * Set detailed information you need
     *
     * @param array $value
     *
     * @return mixed
     */
    public function setDetailInfo(array $value);
}
