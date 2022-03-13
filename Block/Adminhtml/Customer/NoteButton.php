<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Block\Adminhtml\Customer;


use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Ozark\CustomerNotes\Block\Adminhtml\GenericButton\GenericButton;
use Magento\Customer\Controller\RegistryConstants;

class NoteButton extends GenericButton implements ButtonProviderInterface
{


    /**
     * @var \Magento\Framework\Registry
     */
    private $_coreRegistry;
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
        \Magento\Framework\Registry $registry,
        \Ozark\CustomerNotes\Model\NoteRepository $noteRepository,
        \Ozark\CustomerNotes\Model\NoteFactory $noteFactory

    )
    {
        $this->noteRepository = $noteRepository;
        $this->noteFactory = $noteFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * @return array
     */
    public function getButtonData()
    {

        $data = [
            'label' => __('New Customer Note/Complaint'),
            'on_click' => sprintf("location.href = '%s';", $this->getNote()),
            'class' => 'add',
            'sort_order' => 1,
        ];

        return $data;
    }

    private function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    private function getNote(){
        return  $this->getUrl('ozark_customernotes/note/edit' , ['customer_id' => $this->getCustomerId()]);
    }

}