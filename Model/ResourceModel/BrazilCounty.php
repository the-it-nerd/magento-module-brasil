<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterface;

/**
 * Class BrazilCounty
 * @package TheITNerd\Brasil\Model\ResourceModel
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
