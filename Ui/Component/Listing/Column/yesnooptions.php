<?php


namespace Ozark\CustomerNotes\Ui\Component\Listing\Column;

/**
 * Class yesnooptions
 * @package Ozark\CustomerNotes\Ui\Component\Listing\Column
 */
class yesnooptions implements  \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            '0' => __('No'),
            '1' => __('Yes')
        ];
    }
}