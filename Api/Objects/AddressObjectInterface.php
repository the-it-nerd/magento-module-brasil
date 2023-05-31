<?php

namespace TheITNerd\Brasil\Api\Objects;

/**
 * Interface AddressObjectInterface
 * @package TheITNerd\Brasil\Api\Objects
 */
interface AddressObjectInterface
{
    public const POSTCODE = 'postcode';
    public const STREET = 'street';
    public const COMPLEMENT = 'complement';
    public const NEIGHBORHOOD = 'neighborhood';
    public const CITY = 'city';
    public const REGION_ID = 'region_id';

    public const REGION_CODE = 'region_code';
    public const CITY_CODE = 'city_code';
    public const CALLING_CODE = 'calling_code';
    public const COUNTRY = 'country';

    /**
     * @return string|null
     */
    public function getPostcode(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setPostcode(string $value): self;

    /**
     * @return string|null|null
     */
    public function getStreet(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setStreet(string $value): self;

    /**
     * @return string|null
     */
    public function getComplement(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setComplement(string $value): self;

    /**
     * @return string|null
     */
    public function getNeighborhood(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setNeighborhood(string $value): self;

    /**
     * @return string|null
     */
    public function getCity(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setCity(string $value): self;

    /**
     * @return string|null
     */
    public function getRegionCode(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setRegionCode(string $value): self;

    /**
     * @return string|null
     */
    public function getRegionId(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setRegionId(string $value): self;

    /**
     * @return string|null
     */
    public function getCityCode(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setCityCode(string $value): self;

    /**
     * @return string|null
     */
    public function getCallingCode(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setCallingCode(string $value): self;

    /**
     * @return string|null|null
     */
    public function getCountry(): string|null;

    /**
     * @param string $value
     * @return self
     */
    public function setCountry(string $value): self;
}
