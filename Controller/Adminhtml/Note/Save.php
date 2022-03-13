<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml\Note;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class Save extends \Magento\Backend\App\Action
{


    /**
     * @var \Ozark\CustomerNotes\Model\NoteRepository
     */
    private $noteRepository;
    /**
     * @var \Ozark\CustomerNotes\Model\NoteFactory
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


    public function __construct(
        Context $context,
        \Ozark\CustomerNotes\Model\NoteRepository $noteRepository,
        \Ozark\CustomerNotes\Model\NoteFactory $noteFactory,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository
    )

    {
        $this->noteRepository = $noteRepository;
        $this->noteFactory = $noteFactory;
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
        $data = $this->getRequest()->getPostValue();
        if (!$data){
            $this->_redirect('*/*/index');
        }
        $noteId =  $data['entity_id'] ?? null;
        $admin_user = $this->authSession->getUser()->getUserName();
        $customerId = $data['customer_id'] ?? null;
        try{
            if ($noteId == null){
                $newNote = $this->noteFactory->create();
                $newNote->setCustomerId($customerId);
                $newNote->setNote($data['note'] ?? null);
                $newNote->setComplaint($data['complaint'] ?? 0);
                $newNote->setAdminUser($admin_user);
                $newNote->setCustomerName($this->getCustomerName($customerId));

                $this->noteRepository->save($newNote);

            } else {

                $rowData = $this->noteFactory->create()->load($noteId);
                if (!$rowData->getId()) {
                    $this->messageManager->addErrorMessage(__('Note data no longer exists'));
                    $this->_redirect('*/*/index');
                }
                if (!isset($data['customer_name'])){
                    $data['customer_name'] = $this->getCustomerName($customerId);
                }
                $data['admin_user'] = $admin_user;
                $rowData->setData($data);
                $rowData->save();

            }

            $this->messageManager->addSuccessMessage(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('*/*/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ozark_Maxoptra::home');
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