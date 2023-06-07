<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Model\ResourceModel\BrazilCounty;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use TheITNerd\Brasil\Model\ResourceModel\BrazilCounty as BrazilCountyResourceModel;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterface;
use TheITNerd\Brasil\Model\Data\BrazilCounty;

/**
 * Collection class for brazil_county table
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = BrazilCountyInterface::ENTITY_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(BrazilCounty::class, BrazilCountyResourceModel::class);
    }
}
