<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Model\Data;

use Magento\Framework\Model\AbstractExtensibleModel;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterface;
use TheITNerd\Brasil\Model\ResourceModel\BrazilCounty as BrazilCountyResourceModel;

/**
 * Class BrazilCounty
 * @package TheITNerd\Brasil\Model\Data
 */
class BrazilCounty extends AbstractExtensibleModel implements BrazilCountyInterface
{
    /**
     * Object initialization
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(BrazilCountyResourceModel::class);
    }

    /**
     * Sets county ID
     *
     * @param int $countyId
     * @return self
     */
    public function setCountyId(int $countyId): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::COUNTY_ID, $countyId);
    }

    /**
     * Sets county name
     *
     * @param string $countyName
     * @return self
     */
    public function setCountyName(string $countyName): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::COUNTY_NAME, $countyName);
    }

    /**
     * Sets microregion ID
     *
     * @param int $microregionId
     * @return self
     */
    public function setMicroregionId(int $microregionId): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::MICROREGION_ID, $microregionId);
    }

    /**
     * Sets microregion name
     *
     * @param string $microregionName
     * @return self
     */
    public function setMicroregionName(string $microregionName): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::MICROREGION_NAME, $microregionName);
    }

    /**
     * Sets mesoregion ID
     *
     * @param int $mesoregionId
     * @return self
     */
    public function setMesoregionId(int $mesoregionId): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::MESOREGION_ID, $mesoregionId);
    }

    /**
     * Sets mesoregion name
     *
     * @param string $mesoregionName
     * @return self
     */
    public function setMesoregionName(string $mesoregionName): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::MESOREGION_NAME, $mesoregionName);
    }

    /**
     * Sets immediate region ID
     *
     * @param int $immediateRegionId
     * @return self
     */
    public function setImmediateRegionId(int $immediateRegionId): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::IMMEDIATE_REGION_ID, $immediateRegionId);
    }

    /**
     * Sets immediate region name
     *
     * @param string $immediateRegionName
     * @return self
     */
    public function setImmediateRegionName(string $immediateRegionName): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::IMMEDIATE_REGION_NAME, $immediateRegionName);
    }

    /**
     * Sets intermediate region ID
     *
     * @param int $intermediateRegionId
     * @return self
     */
    public function setIntermediateRegionId(int $intermediateRegionId): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::INTERMEDIATE_REGION_ID, $intermediateRegionId);
    }

    /**
     * Sets intermediate region name
     *
     * @param string $intermediateRegionName
     * @return self
     */
    public function setIntermediateRegionName(string $intermediateRegionName): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::INTERMEDIATE_REGION_NAME, $intermediateRegionName);
    }

    /**
     * Sets state ID
     *
     * @param int $stateId
     * @return self
     */
    public function setStateId(int $stateId): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::STATE_ID, $stateId);
    }

    /**
     * Sets state code
     *
     * @param string $stateCode
     * @return self
     */
    public function setStateCode(string $stateCode): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::STATE_CODE, $stateCode);
    }

    /**
     * Sets state name
     *
     * @param string $stateName
     * @return self
     */
    public function setStateName(string $stateName): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::STATE_NAME, $stateName);
    }

    /**
     * Sets region ID
     *
     * @param int $regionId
     * @return self
     */
    public function setRegionId(int $regionId): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::REGION_ID, $regionId);
    }

    /**
     * Sets region code
     *
     * @param string $regionCode
     * @return self
     */
    public function setRegionCode(string $regionCode): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::REGION_CODE, $regionCode);
    }

    /**
     * Sets region name
     *
     * @param string $regionName
     * @return self
     */
    public function setRegionName(string $regionName): BrazilCountyInterface
    {
        return $this->setData(BrazilCountyInterface::REGION_NAME, $regionName);
    }

    /**
     * Gets entity ID
     *
     * @return int
     */
    public function getEntityId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::ENTITY_ID);
    }

    /**
     * Gets county ID
     *
     * @return int
     */
    public function getCountyId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::COUNTY_ID);
    }

    /**
     * Gets county name
     *
     * @return string
     */
    public function getCountyName(): string
    {
        return $this->getData(BrazilCountyInterface::COUNTY_NAME);
    }

    /**
     * Gets microregion ID
     *
     * @return int
     */
    public function getMicroregionId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::MICROREGION_ID);
    }

    /**
     * Gets microregion name
     *
     * @return string
     */
    public function getMicroregionName(): string
    {
        return $this->getData(BrazilCountyInterface::MICROREGION_NAME);
    }

    /**
     * Gets mesoregion ID
     *
     * @return int
     */
    public function getMesoregionId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::MESOREGION_ID);
    }

    /**
     * Gets mesoregion name
     *
     * @return string
     */
    public function getMesoregionName(): string
    {
        return $this->getData(BrazilCountyInterface::MESOREGION_NAME);
    }

    /**
     * Gets immediate region ID
     *
     * @return int
     */
    public function getImmediateRegionId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::IMMEDIATE_REGION_ID);
    }

    /**
     * Gets immediate region name
     *
     * @return string
     */
    public function getImmediateRegionName(): string
    {
        return $this->getData(BrazilCountyInterface::IMMEDIATE_REGION_NAME);
    }

    /**
     * Gets intermediate region ID
     *
     * @return int
     */
    public function getIntermediateRegionId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::INTERMEDIATE_REGION_ID);
    }

    /**
     * Gets intermediate region name
     *
     * @return string
     */
    public function getIntermediateRegionName(): string
    {
        return $this->getData(BrazilCountyInterface::INTERMEDIATE_REGION_NAME);
    }

    /**
     * Gets state ID
     *
     * @return int
     */
    public function getStateId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::STATE_ID);
    }

    /**
     * Gets state code
     *
     * @return string
     */
    public function getStateCode(): string
    {
        return $this->getData(BrazilCountyInterface::STATE_CODE);
    }

    /**
     * Gets state name
     *
     * @return string
     */
    public function getStateName(): string
    {
        return $this->getData(BrazilCountyInterface::STATE_NAME);
    }

    /**
     * Gets region ID
     *
     * @return int
     */
    public function getRegionId(): int
    {
        return (int) $this->getData(BrazilCountyInterface::REGION_ID);
    }

    /**
     * Gets region code
     *
     * @return string
     */
    public function getRegionCode(): string
    {
        return $this->getData(BrazilCountyInterface::REGION_CODE);
    }

    /**
     * Gets region name
     *
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->getData(BrazilCountyInterface::REGION_NAME);
    }
}
