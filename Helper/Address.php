<?php

namespace TheITNerd\Brasil\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Address
 * @package TheITNerd\Brasil\Helper
 */
class Address extends AbstractHelper
{
    public const STREET_ADDRESS_CONFIG = [
        0 => [
            'label' => 'Street',
            'required' => true
        ],
        1 => [
            'label' => 'Number',
            'required' => true
        ],
        2 => [
            'label' => 'Complement',
            'required' => false
        ],
        3 => [
            'label' => 'Neighborhood',
            'required' => true
        ],
    ];

    /**
     * @param int $id
     * @return string|null
     */
    public function getFieldLabel(int $id): string|null
    {
        return self::STREET_ADDRESS_CONFIG[$id]['label'] ?? null;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getWrapperValidationClass(int $id): string
    {
        if ($this->getFieldIsRequired($id)) {
            return 'required';
        }

        return '';
    }

    /**
     * @param int $id
     * @return bool
     */
    public function getFieldIsRequired(int $id): bool
    {
        return isset(self::STREET_ADDRESS_CONFIG[$id]['required']) && self::STREET_ADDRESS_CONFIG[$id]['required'];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getFieldValidationClass(int $id): string
    {
        if (isset(self::STREET_ADDRESS_CONFIG[$id]['required']) && self::STREET_ADDRESS_CONFIG[$id]['required']) {
            return 'required-entry';
        }

        return '';
    }

}
