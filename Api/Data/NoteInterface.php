<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Api\Data;


use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Data\Form\Element\Date;

interface NoteInterface extends ExtensibleDataInterface
{

    CONST ENTITY_ID = 'entity_id';
    CONST CUSTOMER_ID = 'customer_id';
    CONST COMPLAINT = 'complaint';
    CONST NOTE = 'note';
    CONST CREATED_DATETIME = 'created_datetime';
    CONST UPDATED_DATETIME = 'updated_datetime';

    /**
     * @param $id
     * @return int
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @param $customerId
     * @return int
     */
    public function setCustomerId($customerId);

    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @param $complaint
     * @return int
     */
    public function setComplaint($complaint);

    /**
     * @return int
     */
    public function getComplaint();

    /**
     * @param $note
     * @return string
     */
    public function setNote($note);

    /**
     * @return string
     */
    public function getNote();

    /**
     * @return string
     */
    public function getupdatedDatetime($date);


    /**
     * @param $date
     * @return Date
     */
    public function setupdatedDatetime($date);

    /**
     * @return Date
     */
    public function getcreatedDatetime();


    /**
     * @param $date
     * @return Date
     */
    public function setcreatedDatetime($date);



}