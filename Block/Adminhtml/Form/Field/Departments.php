<?php

namespace Ozark\CustomerNotes\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;

class Departments extends AbstractFieldArray
{
    private $dropdownRenderer;

    protected function _prepareToRender()
    {
        $this->addColumn(
            'list_name',
            [
                'label' => __('List Name'),
                'class' => 'required-entry',
            ]
        );
        $this->addColumn(
            'enabled',
            [
                'label' => __('Enabled'),
                'renderer' => $this->getDropdownRenderer(),
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    protected function _prepareArrayRow(DataObject $row)
    {
        $options = [];
        $dropdownField = $row->getDropdownField();
        if ($dropdownField !== null) {
            $options['option_' . $this->getDropdownRenderer()->calcOptionHash($dropdownField)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

    private function getDropdownRenderer()
    {
        if (!$this->dropdownRenderer) {
            $this->dropdownRenderer = $this->getLayout()->createBlock(
                \Magento\Framework\View\Element\Html\Select::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            )->setOptions([
                ['value' => '1', 'label' => __('Yes')],
                ['value' => '0', 'label' => __('No')],
            ]);
        }
        return $this->dropdownRenderer;
    }
}
