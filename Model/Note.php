<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Model;

use Magento\Framework\Data\Form\Element\Date;
use Ozark\CustomerNotes\Api\Data\NoteInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Note extends AbstractExtensibleModel implements NoteInterface
{

    protected function _construct()
    {
        $this->_init(ResourceModel\Note::class);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setComplaint($complaint)
    {
        return $this->setData(self::COMPLAINT, $complaint);
    }

    /**
     * @inheritDoc
     */
    public function getComplaint()
    {
        return $this->getData(self::COMPLAINT);
    }

    /**
     * @inheritDoc
     */
    public function setNote($note)
    {
        return $this->setData(self::NOTE, $note);
    }

    /**
     * @inheritDoc
     */
    public function getNote()
    {
        return $this->getData(self::NOTE);
    }

    /**
     * @inheritDoc
     */
    public function getupdatedDatetime($date)
    {
        return $this->getData(self::UPDATED_DATETIME);
    }

    /**
     * @inheritDoc
     */
    public function setupdatedDatetime($date)
    {
        return $this->setData(self::UPDATED_DATETIME, $date);
    }

    /**
     * @inheritDoc
     */
    public function getcreatedDatetime()
    {
        return $this->getData(self::CREATED_DATETIME);
    }

    /**
     * @inheritDoc
     */
    public function setcreatedDatetime($date)
    {
        return $this->setData(self::CREATED_DATETIME, $date);
    }
}