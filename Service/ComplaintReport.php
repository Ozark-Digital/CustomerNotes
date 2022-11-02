<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Service;


use Dompdf\Dompdf;

class ComplaintReport
{
    /**
     * @var ComplaintDurationChecker
     */
    private $complaintDurationChecker;
    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;
    /**
     * @var \Ozark\StockManage\Model\nextDeliveryDate
     */
    private $nextDeliveryDate;
    /**
     * @var \Ozark\StockManage\Model\PDF
     */
    private $PDF;
    /**
     * @var \Ozark\StockManage\Model\email
     */
    private $email;

    public function __construct(
        \Ozark\CustomerNotes\Service\ComplaintDurationChecker $complaintDurationChecker,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Ozark\StockManage\Model\PDF $PDF,
        \Ozark\StockManage\Model\email $email,
        \Ozark\StockManage\Model\nextDeliveryDate $nextDeliveryDate

    ){
        $this->complaintDurationChecker = $complaintDurationChecker;
        $this->timezone = $timezone;
        $this->PDF = $PDF;
        $this->email = $email;
        $this->nextDeliveryDate = $nextDeliveryDate;
    }

    public function sendComplaintReport(){
        $complaints = $this->complaintDurationChecker->getComplaintsWithinWeek();
        $itemData = [];

        foreach ($complaints->getItems() as $item){
            if ($item->getComplaint() == '1'){
                $arr = [$item->getCustomerName(), $item->getNote(), $item->getSolution(), $item->getcreatedDatetime()];
                array_push( $itemData, $arr);
            }
        }
        $fileName = 'ComplaintReport';
        $filePath = $this->PDF->generateComplaintReportPDF($itemData, $fileName);
        $this->email->sendPdfEmail($fileName, $filePath,
            $this->nextDeliveryDate->getNextDeliveryDate(), 'Daily');
    }

}