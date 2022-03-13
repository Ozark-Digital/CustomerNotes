<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

abstract class Note extends Action
{

    const ADMIN_RESOURCE = 'Magento_Catalog::catalog';

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Ozark'), __('Ozark'))
            ->addBreadcrumb(__('Customer Notes'), __('Customer Notes'));
        return $resultPage;
    }


}