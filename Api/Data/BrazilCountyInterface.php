<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Api\Data;

/**
 * Interface BrazilCountyInterface
 * @package TheITNerd\Brasil\Api\Data
 */
interface BrazilCountyInterface
{
    /** @var string TABLE */
    public const TABLE = 'brazil_county';

    /** @var string ENTITY_ID */
    public const ENTITY_ID = 'entity_id';

    /** @var string COUNTY_ID */
    public const COUNTY_ID = 'county_id';

    /** @var string COUNTY_NAME */
    public const COUNTY_NAME = 'county_name';

    /** @var string MICROREGION_ID */
    public const MICROREGION_ID = 'microregion_id';

    /** @var string MICROREGION_NAME */
    public const MICROREGION_NAME = 'microregion_name';

    /** @var string MESOREGION_ID */
    public const MESOREGION_ID = 'mesoregion_id';

    /** @var string MESOREGION_NAME */
    public const MESOREGION_NAME = 'mesoregion_name';

    /** @var string IMMEDIATE_REGION_ID */
    public const IMMEDIATE_REGION_ID = 'immediate_region_id';

    /** @var string IMMEDIATE_REGION_NAME */
    public const IMMEDIATE_REGION_NAME = 'immediate_region_name';

    /** @var string INTERMEDIATE_REGION_ID */
    public const INTERMEDIATE_REGION_ID = 'intermediate_region_id';

    /** @var string INTERMEDIATE_REGION_NAME */
    public const INTERMEDIATE_REGION_NAME = 'intermediate_region_name';

    /** @var string STATE_ID */
    public const STATE_ID = 'state_id';

    /** @var string STATE_CODE */
    public const STATE_CODE = 'state_code';

    /** @var string STATE_NAME */
    public const STATE_NAME = 'state_name';

    /** @var string REGION_ID */
    public const REGION_ID = 'region_id';

    /** @var string REGION_CODE */
    public const REGION_CODE = 'region_code';

    /** @var string REGION_NAME */
    public const REGION_NAME = 'region_name';

    /**
     * Sets county ID
     *
     * @param int $countyId
     * @return self
     */
    public function setCountyId(int $countyId): BrazilCountyInterface;
    /**
     * Sets county name
     *
     * @param string $countyName
     * @return self
     */
    public function setCountyName(string $countyName): BrazilCountyInterface;

    /**
     * Sets microregion ID
     *
     * @param int $microregionId
     * @return self
     */
    public function setMicroregionId(int $microregionId): BrazilCountyInterface;

    /**
     * Sets microregion name
     *
     * @param string $microregionName
     * @return self
     */
    public function setMicroregionName(string $microregionName): BrazilCountyInterface;

    /**
     * Sets mesoregion ID
     *
     * @param int $mesoregionId
     * @return self
     */
    public function setMesoregionId(int $mesoregionId): BrazilCountyInterface;

    /**
     * Sets mesoregion name
     *
     * @param string $mesoregionName
     * @return self
     */
    public function setMesoregionName(string $mesoregionName): BrazilCountyInterface;

    /**
     * Sets immediate region ID
     *
     * @param int $immediateRegionId
     * @return self
     */
    public function setImmediateRegionId(int $immediateRegionId): BrazilCountyInterface;

    /**
     * Sets immediate region name
     *
     * @param string $immediateRegionName
     * @return self
     */
    public function setImmediateRegionName(string $immediateRegionName): BrazilCountyInterface;

    /**
     * Sets intermediate region ID
     *
     * @param int $intermediateRegionId
     * @return self
     */
    public function setIntermediateRegionId(int $intermediateRegionId): BrazilCountyInterface;
    /**
     * Sets intermediate region name
     *
     * @param string $intermediateRegionName
     * @return self
     */
    public function setIntermediateRegionName(string $intermediateRegionName): BrazilCountyInterface;

    /**
     * Sets state ID
     *
     * @param int $stateId
     * @return self
     */
    public function setStateId(int $stateId): BrazilCountyInterface;

    /**
     * Sets state code
     *
     * @param string $stateCode
     * @return self
     */
    public function setStateCode(string $stateCode): BrazilCountyInterface;

    /**
     * Sets state name
     *
     * @param string $stateName
     * @return self
     */
    public function setStateName(string $stateName): BrazilCountyInterface;

    /**
     * Sets region ID
     *
     * @param int $regionId
     * @return self
     */
    public function setRegionId(int $regionId): BrazilCountyInterface;

    /**
     * Sets region code
     *
     * @param string $regionCode
     * @return self
     */
    public function setRegionCode(string $regionCode): BrazilCountyInterface;

    /**
     * Sets region name
     *
     * @param string $regionName
     * @return self
     */
    public function setRegionName(string $regionName): BrazilCountyInterface;

    /**
     * Gets entity ID
     *
     * @return int
     */
    public function getEntityId(): int;

    /**
     * Gets county ID
     *
     * @return int
     */
    public function getCountyId(): int;

    /**
     * Gets county name
     *
     * @return string
     */
    public function getCountyName(): string;

    /**
     * Gets microregion ID
     *
     * @return int
     */
    public function getMicroregionId(): int;

    /**
     * Gets microregion name
     *
     * @return string
     */
    public function getMicroregionName(): string;

    /**
     * Gets mesoregion ID
     *
     * @return int
     */
    public function getMesoregionId(): int;

    /**
     * Gets mesoregion name
     *
     * @return string
     */
    public function getMesoregionName(): string;

    /**
     * Gets immediate region ID
     *
     * @return int
     */
    public function getImmediateRegionId(): int;

    /**
     * Gets immediate region name
     *
     * @return string
     */
    public function getImmediateRegionName(): string;

    /**
     * Gets intermediate region ID
     *
     * @return int
     */
    public function getIntermediateRegionId(): int;

    /**
     * Gets intermediate region name
     *
     * @return string
     */
    public function getIntermediateRegionName(): string;

    /**
     * Gets state ID
     *
     * @return int
     */
    public function getStateId(): int;

    /**
     * Gets state code
     *
     * @return string
     */
    public function getStateCode(): string;

    /**
     * Gets state name
     *
     * @return string
     */
    public function getStateName(): string;

    /**
     * Gets region ID
     *
     * @return int
     */
    public function getRegionId(): int;

    /**
     * Gets region code
     *
     * @return string
     */
    public function getRegionCode(): string;

    /**
     * Gets region name
     *
     * @return string
     */
    public function getRegionName(): string;
}
