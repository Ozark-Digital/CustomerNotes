<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Api\Data;


use Magento\Framework\Api\SearchResultsInterface;

interface NoteSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Ozark\CustomerNotes\Api\Data\NoteInterface[]
     */
    public function getItems();

    /**
     * @param \Ozark\CustomerNotes\Api\Data\NoteInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}