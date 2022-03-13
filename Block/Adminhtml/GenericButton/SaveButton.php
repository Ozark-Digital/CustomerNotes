<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Block\Adminhtml\GenericButton;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Ozark\StockManage\Block\Adminhtml\StockBrought\Edit\GenericButton;

class SaveButton  extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Item'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}