<?php
/************************************************************
 * *
 *  * Copyright © W4PLEGO. All rights reserved.
 *  * See COPYING.txt for license details.
 *  *
 *  * @author    info@w4plego.com
 * *  @project   Core
 */
namespace W4PLEGO\Base\Block\Adminhtml\Edit\Button;

use Magento\Backend\Block\Template;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Save
 *
 * @package W4PLEGO\Base\Block\Adminhtml\Edit\Button
 */
class Save extends Template implements ButtonProviderInterface
{
    /**
     * Save button
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 100,
        ];
    }
}
