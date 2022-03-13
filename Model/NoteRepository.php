<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;


use Ozark\CustomerNotes\Api\Data\NoteSearchResultInterface;
use Ozark\CustomerNotes\Api\Data\NoteSearchResultInterfaceFactory;
use Ozark\CustomerNotes\Model\ResourceModel\Note;


use Ozark\CustomerNotes\Api\NoteRepositoryInterface;
use Ozark\CustomerNotes\Api\Data\NoteInterface;

use Ozark\CustomerNotes\Model\ResourceModel\Note\CollectionFactory;




class NoteRepository implements NoteRepositoryInterface
{

    /**
     * @var NoteFactory
     */
    private $noteFactory;
    /**
     * @var Note
     */
    private $noteResource;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var NoteSearchResultInterfaceFactory
     */
    private $noteSearchResultInterfaceFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    private $searchResultFactory;

    public function __construct(
        NoteFactory $noteFactory,
        Note $noteResource,
        CollectionFactory $collectionFactory,
        NoteSearchResultInterfaceFactory $noteSearchResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor

    ){
        $this->noteFactory = $noteFactory;
        $this->noteResource = $noteResource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultFactory = $noteSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }


    /**
     * @param int $id
     * @return \Ozark\CustomerNotes\Api\Data\NoteInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id)
    {
        $note = $this->noteFactory->create();
        $this->noteResource->load($note, $id);
        if (!$note->getId()){
            throw new NoSuchEntityException(__('Unable to find Collection with ID "%1"', $id));
        }
        return $note;
    }

    /**
     * @param NoteInterface $notes
     * @return NoteInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(\Ozark\CustomerNotes\Api\Data\NoteInterface $notes)
    {
        $this->noteResource->save($notes);
        return $notes;
    }

    /**
     * @param NoteInterface $notes
     * @return bool|void
     * @throws CouldNotDeleteException
     */
    public function delete(\Ozark\CustomerNotes\Api\Data\NoteInterface $notes)
    {
        try {
            $this->noteResource->delete($notes);
        } catch (\Exception $exception){
            throw new CouldNotDeleteException(
                __('Could not delete the note: %1', $exception->getMessage())
            );
        }
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return NoteSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionBookFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}