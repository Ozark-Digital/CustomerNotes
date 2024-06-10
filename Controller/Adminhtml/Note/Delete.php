<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml\Note;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Delete extends \Magento\Backend\App\Action
{


    /**
     * @var \Ozark\CustomerNotes\Model\NoteRepository
     */
    private $noteRepository;
    /**
     * @var \Ozark\CustomerNotes\Model\NoteFactory
     */
    private $noteFactory;

    public function __construct(
        Context $context,
        \Ozark\CustomerNotes\Model\NoteRepository $noteRepository,
        \Ozark\CustomerNotes\Model\NoteFactory $noteFactory
    )

    {
        $this->noteRepository = $noteRepository;
        $this->noteFactory = $noteFactory;
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

        $rowData = $this->noteFactory->create()->load($noteId);
        if (!$rowData->getId()) {
            $this->messageManager->addErrorMessage(__('Complaint data no longer exists'));
            $this->_redirect('*/*/index');
        }
        $rowData->delete();
        $this->messageManager->addSuccessMessage(__('Note data base been deleted!'));
    }
}