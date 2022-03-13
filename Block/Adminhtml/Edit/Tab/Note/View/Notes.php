<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Block\Adminhtml\Edit\Tab\Note\View;


use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use SuttonSilver\BobTailManagment\Ui\Component\Listing\Column\SubscriptionActions;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Registry;
use Ozark\CustomerNotes\Ui\Component\Listing\Column\yesnooptions;

use Ozark\CustomerNotes\Model\ResourceModel\Note\CollectionFactory;

class Notes  extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_coreRegistry = null;
    /**
     * @var CollectionFactory
     */
    private $_collectionFactory;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilderFactory;
    /**
     * @var yesnooptions
     */
    private $yesnooptions;

    public function __construct(
        Context $context,
        Data $backendHelper,
        CollectionFactory $collectionFactory,
        Registry $coreRegistry,
        SearchCriteriaBuilder $searchCriteriaBuilderFactory,
        yesnooptions $yesnooptions,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->yesnooptions = $yesnooptions;
        $this->_collectionFactory = $collectionFactory;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct(){
        parent::_construct();
        $this->setId('note_table');
        $this->setDefaultSort('entity_id');
        $this->setSortable(true);
        $this->setPagerVisibility(true);
        $this->setFilterVisibility(true);
        $this->setUseAjax(true);
        $this->_addButtonLabel = __('Add New Slideshow');

    }

    protected function _prepareCollection()
    {

        $collection = $this->_collectionFactory->create();


        $collection->addFilter('customer_id',
            $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID));


        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns(){
        $this->addColumn(
            'entity_id',
            ['header' => __('ID'), 'index' => 'entity_id', 'type' => 'number', 'width' => '100px']
        );
        $this->addColumn(
            'note',
            [
                'header' => __('Note'),
                'index' => 'note',
            ]
        );
        $this->addColumn(
            'complaint',
            [
                'header' => __('Is Complaint'),
                'index' => 'complaint',
                'type' => 'options',
                'options' => $this->yesnooptions->getOptions()
            ]
        );

        $this->addColumn(
            'created_datetime',
            [
                'header' => __('Created Datetime'),
                'index' => 'created_datetime',
            ]
        );

        $this->addColumn(
            'updated_datetime',
            [
                'header' => __('Updated Datetime'),
                'index' => 'updated_datetime',
            ]
        );

        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'ozark_customernotes/note/edit',
                        ],
                        'field' => 'subscription_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );



        return parent::_prepareColumns();
    }

    public function getHeadersVisibility()
    {
        return $this->getCollection()->getSize() >= 0;
    }

    public function getRowUrl($item)
    {

        return $this->getUrl('ozark_customernotes/note/edit', ['id' => $item->getEntityId()]);
    }

    public function getNoteEditUrl($item): string
    {
        return $this->getRowUrl($item);
    }

}