<?php

namespace TheITNerd\Brasil\Setup\Patch\Data;


use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class UpdateAddressStreetLinesNumber
 * @package TheITNerd\Brasil\Setup\Patch\Data
 */
class UpdateAddressStreetLinesNumber implements DataPatchInterface
{

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly EavSetupFactory          $eavSetupFactory
    )
    {
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $this->updateCoreConfigData()
            ->updateAttributeMetaData();

        $this->moduleDataSetup->endSetup();
    }

    private function updateAttributeMetaData(): self
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->updateAttribute(
            AddressMetadataInterface::ATTRIBUTE_SET_ID_ADDRESS,
            'street',
            'multiline_count',
            4
        );

        return $this;
    }

    /**
     * @return self
     */
    private function updateCoreConfigData(): self
    {
        $configTable = $this->moduleDataSetup->getTable('core_config_data');
        $select = $this->moduleDataSetup->getConnection()->select()
            ->from($configTable)
            ->where('path = ?', 'customer/address/street_lines');
        $config = $this->moduleDataSetup->getConnection()->fetchAll($select);

        if (!empty($config)) {
            $this->moduleDataSetup->getConnection()->update(
                $configTable,
                ['value' => '4'],
                ['path = ?' => 'customer/address/street_lines']
            );
        } else {
            $this->moduleDataSetup->getConnection()->insert(
                $configTable,
                [
                    'value' => '4',
                    'path' => 'customer/address/street_lines',
                    'scope' => 'default',
                    'scope_id' => 0
                ]
            );
        }

        return $this;
    }
}
