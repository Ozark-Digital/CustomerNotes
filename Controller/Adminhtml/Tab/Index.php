<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml\Tab;


use Magento\Framework\App\ResponseInterface;

class Index extends \Magento\Customer\Controller\Adminhtml\Index
{

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $this->initCurrentCustomer();
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }
}