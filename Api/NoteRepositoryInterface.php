<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Api;


interface NoteRepositoryInterface
{
    /**
     * @param int $id
     * @return \Ozark\CustomerNotes\Api\Data\NoteInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Ozark\CustomerNotes\Api\Data\NoteInterface $notes
     * @return \Ozark\CustomerNotes\Api\Data\NoteInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Ozark\CustomerNotes\Api\Data\NoteInterface $notes);

    /**
     * @param \Ozark\CustomerNotes\Api\Data\NoteInterface $notes
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Ozark\CustomerNotes\Api\Data\NoteInterface $notes);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ozark\CustomerNotes\Api\Data\NoteSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

}