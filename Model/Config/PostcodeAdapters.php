<?php

namespace TheITNerd\Brasil\Model\Config;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Data\OptionSourceInterface;
use TheITNerd\Brasil\Api\Adapters\PostcodeClientInterface;

/**
 * Class PostcodeAdapters
 * @package TheITNerd\Brasil\Model\Config
 */
class PostcodeAdapters implements OptionSourceInterface
{
    /**
     * @var array
     */
    private array $adapters;

    /**
     * @param array $adapters
     */
    public function __construct(
        array $adapters = []
    )
    {
        $this->adapters = $adapters;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        foreach ($this->toOptionArray() as $adapter) {
            $data[$adapter['value']] = $adapter['label'];
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $data = [];

        foreach ($this->adapters as $adapter) {
            /**
             * @var $tmpClass PostcodeClientInterface
             */
            $tmpClass = ObjectManager::getInstance()->get($adapter);

            $data[] = [
                'label' => __($tmpClass->getLabel()),
                'value' => $adapter
            ];
        }

        return $data;
    }
}
