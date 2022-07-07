<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml\Report;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class complaint extends Action
{


    /**
     * @var \Ozark\StockManage\Service\ComplaintReport
     */
    private $complaintReport;
    /**
     * @var PageFactory
     */
    private $resultPageFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    public function __construct(
        \Ozark\StockManage\Service\ComplaintReport $complaintReport,
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry)
    {
        $this->complaintReport = $complaintReport;
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->complaintReport->sendComplaintReport();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccessMessage(__('Complaint Report has been emailed!'));
        return $resultRedirect->setPath('*/*/');
    }


    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ozark_Maxoptra::home');
    }

}