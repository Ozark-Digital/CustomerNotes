<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Block\Adminhtml\Edit\Tab\Note;


use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;

class Notes extends \Magento\Backend\Block\Template implements TabInterface
{

    /**
     * @var \Magento\Framework\Registry
     */
    private $_coreRegistry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @inheritDoc
     */
    public function getTabLabel()
    {
        return __('Customer Notes & Complaints');
    }

    /**
     * @inheritDoc
     */
    public function getTabTitle()
    {
        return __('Customer Notes & Complaints');
    }

    /**
     * @inheritDoc
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getTabUrl()
    {
        return $this->getUrl('ozark_customernotes/tab/index', ['_current' => true]);
    }

    /**
     * @inheritDoc
     */
    public function isAjaxLoaded()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isHidden()
    {
        if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }

    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }
}