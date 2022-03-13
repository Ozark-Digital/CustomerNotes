<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Controller\Adminhtml\Note;


class MassDelete extends \Magento\Backend\App\Action
{


    /**
     * @var \Ozark\CustomerNotes\Model\NoteFactory
     */
    private $_noteFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Ozark\CustomerNotes\Model\NoteFactory $noteFactory
    )
    {
        $this->_noteFactory = $noteFactory;
        parent::__construct($context);
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $selectedIds = $data['selected'];
        try {
            foreach ($selectedIds as $selectedId) {
                $deleteData = $this->_noteFactory->create()->load($selectedId);
                $deleteData->delete();
            }
            $this->messageManager->addSuccess(__('Row data has been successfully deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('ozark_stockmanage/stockbrought/index');
    }

}