<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Model\ResourceModel\Note;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Ozark\CustomerNotes\Model\ResourceModel\Note;

class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init(\Ozark\CustomerNotes\Model\Note::class,
        Note::class);
    }


}