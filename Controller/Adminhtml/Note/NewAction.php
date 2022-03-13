<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml\Note;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Ozark\CustomerNotes\Model\NoteFactory;

class NewAction extends Action
{


    /**
     * @var PageFactory
     */
    private $pageFactory;
    /**
     * @var NoteFactory
     */
    private $_noteFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        NoteFactory $_noteFactory,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->pageFactory = $rawFactory;
        $this->_noteFactory = $_noteFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Magento_Customer::customer');
        $title = __('Add Item');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ozark_CustomerNotes::home');
    }
}