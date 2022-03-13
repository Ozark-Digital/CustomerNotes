<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Model\Note;


use Magento\Framework\App\Request\DataPersistorInterface;
use Ozark\CustomerNotes\Model\ResourceModel\Note\CollectionFactory;
use Ozark\CustomerNotes\Model\ResourceModel\Note\Collection;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var
     */
    protected $loadedData;

    /**
     * @var
     */
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
        }
        $data = $this->dataPersistor->get('ozark_customernotes_customernotes');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();

            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('ozark_customernotes_customernotes');
        }

        return $this->loadedData;
    }

}