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
    CONST CUSTOMER_NAME = 'customer_name';
    CONST ADMIN_USER = 'admin_user';
    const SOLUTION = 'solution';
    const NATUREOFISSUE = 'nature_of_issue';
    const RESPONSIBILITY = 'responsibility';


    /**
     * @return int
     */
    public function getResponsibility();

    /**
     * @param $responsibility
     * @return int
     */
    public function setResponsibility($responsibility);

    /**
     * @return int
     */
    public function getNatureOfIssue();

    /**
     * @param $natureOfIssue
     * @return int
     */
    public function setNatureOfIssue($natureOfIssue);

    /**
     * @return string
     */
    public function getSolution();

    /**
     * @param $solution
     * @return string
     */
    public function setSolution($solution);


    /**
     * @param $customerName
     * @return string
     */
    public function setCustomerName($customerName);

    /**
     * @return string
     */
    public function getCustomerName();

    /**
     * @param $adminUser
     * @return string
     */
    public function setAdminUser($adminUser);

    /**
     * @param $adminUser
     * @return string
     */
    public function getAdminUser();

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
    public function getupdatedDatetime();


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


    /**
     * @return \Ozark\CustomerNotes\Api\Data\NoteExtensionInterface
     */
    public function getExtensionAttributes();

    /**
     * @param \Ozark\CustomerNotes\Api\Data\NoteExtensionInterface $extensionAttributes
     * @return mixed
     */
    public function setExtensionAttributes(NoteExtensionInterface $extensionAttributes);

}