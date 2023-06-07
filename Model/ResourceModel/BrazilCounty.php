<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterface;

/**
 * Resource model for brazil_county table
 */
class BrazilCounty extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(BrazilCountyInterface::TABLE, BrazilCountyInterface::ENTITY_ID);
    }
}
