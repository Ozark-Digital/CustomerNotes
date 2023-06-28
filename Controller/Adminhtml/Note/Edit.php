<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml\Note;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Ozark\CustomerNotes\Model\NoteFactory;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;
    /**
     * @var \Ozark\CustomerNotes\Model\NoteRepository
     */
    private $noteRepository;
    /**
     * @var NoteFactory
     */
    private $noteFactory;
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    private $authSession;
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;
    /**
     * @var \Magento\Customer\Api\AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Ozark\CustomerNotes\Model\NoteRepository $noteRepository,
        \Ozark\CustomerNotes\Model\NoteFactory $noteFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->noteRepository = $noteRepository;
        $this->noteFactory = $noteFactory;
        $this->coreRegistry = $coreRegistry;
        $this->authSession = $authSession;
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        
       
        
        $parms = $this->getRequest()->getParams();
        $customerId = $parms['customer_id'] ?? null;

        if ($customerId){
           $parms['id'] = $this->makeNewNote($customerId);
           $resultRedirect = $this->resultRedirectFactory->create();
           return $resultRedirect->setPath('ozark_customernotes/note/edit', ['id' => $parms['id']]);
        }
        
        $rowId = (int)$parms['id'];
        $title = $rowId ? __('Edit Complaint') : __('Add Complaint');


        $resultPage = $this->resultPageFactory->create();
        $resultPage->initLayout();
        $resultPage->getConfig()->getTitle()->prepend(__($title));
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ozark_CustomerNotes::home');
    }

    private function makeNewNote($customerId){
        $newNote = $this->noteFactory->create();
        $newNote->setAdminUser($this->authSession->getUser()->getUserName());
        $newNote->setCustomerName($this->getCustomerName($customerId));
        $newNote->setCustomerId($customerId);
        $note = $this->noteRepository->save($newNote);
        return $note->getId();
    }

    /**
     * @param $customerId
     * @return string|null
     */
    private function getCustomerName($customerId)
    {
        try {
            $customer = $this->customerRepository->getById($customerId);
            $shipping = $this->addressRepository->getById($customer->getDefaultShipping());

            $customerName = $shipping->getCompany();
            if ($customerName == null){
                $customerName = $shipping->getFirstname() . " " . $shipping->getLastname();
            }

        } catch (NoSuchEntityException | LocalizedException $exception){
            return null;
        }
        return $customerName;
    }
}