<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Service;


class ComplaintDurationChecker
{
    /**
     * @var \Ozark\CustomerNotes\Model\NoteFactory
     */
    private $noteFactory;
    /**
     * @var \Ozark\CustomerNotes\Model\NoteRepository
     */
    private $noteRepository;
    /**
     * @var \Ozark\CustomerNotes\Model\ResourceModel\Note\CollectionFactory
     */
    private $noteCollectionFactory;
    
    
    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;
    /**
     * @var \Magento\Framework\Api\Search\FilterGroupBuilder
     */
    private $filterGroupBuilder;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaInterface
     */
    private $searchCriteriaBuilder;
    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var \Magento\Framework\Api\SortOrderBuilder
     */
    private $sortBuilder;


    public function __construct(
        \Ozark\CustomerNotes\Model\NoteFactory $noteFactory,
        \Ozark\CustomerNotes\Model\NoteRepository $noteRepository,
        \Ozark\CustomerNotes\Model\ResourceModel\Note\CollectionFactory $noteCollectionFactory,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteriaBuilder,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Api\Search\FilterGroup $filterGroupBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortBuilder


    ){
        $this->noteFactory = $noteFactory;
        $this->noteRepository = $noteRepository;
        $this->noteCollectionFactory = $noteCollectionFactory;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->timezone = $timezone;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->sortBuilder = $sortBuilder;
    }


    /**
     * @param $customerId
     * @return bool
     */
    public function isComplaintWithinDay($customerId = null): bool
    {
        return $this->hasComplaints($this->getComplaints('-31 days', $customerId));
    }

    /**
     * @param $customerId
     * @return bool
     */
    public function isComplaintWithinWeek($customerId = null): bool
    {
        return $this->hasComplaints($this->getComplaints('-31 days', $customerId));
    }

    /**
     * @param $customerId
     * @return bool
     */
    public function isComplaintWithinMonth($customerId = null): bool
    {
        return $this->hasComplaints($this->getComplaints('-31 days', $customerId));
    }

    /**
     * @param null $customerId
     * @return \Ozark\CustomerNotes\Api\Data\NoteSearchResultInterface
     */
    public function getComplaintsWithinWeek($customerId = null){
        return $this->getComplaints( '-7 days', $customerId);
    }

    /**
     * @param $collection
     * @return bool
     */
    private function hasComplaints($collection): bool
    {
        if ($collection->getItems() != 0){
            foreach ($collection->getItems() as $item){
                if ($item->getComplaint() == '1'){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $customerId
     * @param $days
     * @return \Ozark\CustomerNotes\Api\Data\NoteSearchResultInterface
     */
    private function getComplaints($days, $customerId = null){
        $customDateGreater = $this->timezone->date()->modify($days)->format('Y-m-d H:i:s');

//        $filter1 = $this->filterBuilder
//            ->create()
//            ->setField('complaint')
//            ->setValue(0)
//            ->setConditionType('gt');
//
//        $filterGroup1 = $this->filterGroupBuilder->setFilters([$filter1]);


        $filter2 = $this->filterBuilder
            ->create()
            ->setField('updated_datetime')
            ->setValue($customDateGreater)
            ->setConditionType('gt');

        $filterGroup2 = $this->filterGroupBuilder->setFilters([$filter2]);

        $search = $this->searchCriteriaBuilder
            ->setFilterGroups([$filterGroup2]);

        if ($customerId != null){

            $filter3 = $this->filterBuilder
                ->create()
                ->setField('customer_id')
                ->setValue($customerId)
                ->setConditionType('eq');

            $filterGroup3 = $this->filterGroupBuilder->setFilters([$filter3]);

            $search = $this->searchCriteriaBuilder
                ->setFilterGroups([$filterGroup2, $filterGroup3]);

        }

        $sortOrder = $this->sortBuilder->setField('updated_datetime')->setDescendingDirection()->create();
        $search->setSortOrders([$sortOrder]);

        return  $this->noteRepository->getList($search);


    }
}