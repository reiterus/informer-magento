<?php

/**
 * @copyright   Copyright (c) 2022 Reiterus
 * @author      Pavel Vasin <reiterus@yandex.ru>
 */

namespace Vendor\Module\Plugin;

use Reiterus\Informer\Model\Informer;

/**
 * Class Informer
 * @package Reiterus\Plugin
 */
class InformerBefore
{
    /**
     * Run method before Informer::getDetailInfo
     *
     * @param Informer $subject
     *
     * @return null
     */
    public function beforeGetDetailInfo(Informer $subject)
    {
        $subject->setDetailInfo([
            'key_1' => 'value_1',
            'key_2' => 'value_2',
            'key_3' => 'value_3',
        ]);

        return null;
    }
}
