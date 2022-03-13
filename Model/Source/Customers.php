<?php

/**
 * @author Joseph Young (josephyoung658@gmail.com)
 */


namespace Ozark\CustomerNotes\Model\Source;




use Magento\Framework\App\CacheInterface;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Serialize\SerializerInterface;

class Customers implements \Magento\Framework\Data\OptionSourceInterface
{


    /**
     * @var CollectionFactory
     */
    private $customerCollection;
    /**
     * @var DataObjectFactory
     */
    private $dataObjectFactory;
    /**
     * @var CacheInterface
     */
    private $cache;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    private $_customerFactory;
    /**
     * @var \Magento\Customer\Model\Customer
     */
    private $_customer;

    protected $cacheName = 'ozark_customer_options';

    public function __construct(
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory,
        DataObjectFactory $dataObjectFactory,
        CacheInterface $cache,
        SerializerInterface $serializer
    ) {
        $this->_customerFactory = $customerFactory;
        $this->dataObjectFactory = $dataObjectFactory;
        $this->cache = $cache;
        $this->serializer = $serializer;

    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $data = $this->cache->load($this->cacheName);
        if ($data == null){
            $options = [];
            $collection = $this->getCustomerCollection();
            foreach ($collection as $customer){
                $options[$customer->getId()] = [
                    'value' => $customer->getId(),
                    'label' => $customer->getEmail(),
                    'is_active' => $customer->getStatus(),
                    'path' => $customer->getEmail(),
                    'optgroup' => false
                ];
            }
            $data = $this->serializer->serialize($options);
            $this->cache->save($data, $this->cacheName, [], 3600);
            $data = $this->cache->load($this->cacheName);
        }
        return $this->serializer->unserialize($data);
    }

    private function getCustomerCollection() {
        return $this->_customerFactory->create();
    }
}