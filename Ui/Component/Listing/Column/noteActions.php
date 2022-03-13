<?php
/**
 * Joseph Young joseph@ozarkdigital.co.uk
 * 2021
 *
 */

namespace Ozark\CustomerNotes\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class noteActions
 * @package Ozark\CustomerNotes\Ui\Component\Listing\Column
 */
class noteActions extends Column
{
    const URL_PATH_DELETE = 'ozark_customernotes/note/delete';
    const URL_PATH_DETAILS = 'ozark_customernotes/note/details';
    const URL_PATH_EDIT = 'ozark_customernotes/note/edit';
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');

            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                    'href' => $this->urlBuilder->getUrl(
                        static::URL_PATH_EDIT,
                        ['id' => $item['entity_id'], 'store' => $storeId]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                    '__disableTmpl' => true
                ]];
            }
        }


        return $dataSource;
    }
}

