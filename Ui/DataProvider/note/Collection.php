<?php


namespace Ozark\CustomerNotes\Ui\DataProvider\note;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Class Collection
 * @package Ozark\CustomerNotes\Ui\DataProvider\note
 */
class Collection extends SearchResult
{

    protected function _initSelect() {
    $this->addFilterToMap('entity_id', 'ozark_customernotes_customernotes.entity_id');
    return parent::_initSelect();
}

}