<?php

namespace TheITNerd\Brasil\Model\DataObjects;

use Magento\Framework\DataObject;
use TheITNerd\Brasil\Api\Objects\AddressObjectInterface;

/**
 * Class AddressObject
 * @package TheITNerd\Brasil\Model\DataObjects
 */
class AddressObject extends DataObject implements AddressObjectInterface
{

    /**
     * {@inheritDoc}
     */
    public function getPostcode(): string
    {
        return $this->getData(self::POSTCODE);
    }

    /**
     * {@inheritDoc}
     */
    public function setPostcode(string $value): AddressObjectInterface
    {
        return $this->setData(self::POSTCODE, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getStreet(): string
    {
        return $this->getData(self::STREET);
    }

    /**
     * {@inheritDoc}
     */
    public function setStreet(string $value): AddressObjectInterface
    {
        return $this->setData(self::STREET, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getComplement(): string
    {
        return $this->getData(self::COMPLEMENT);
    }

    /**
     * {@inheritDoc}
     */
    public function setComplement(string $value): AddressObjectInterface
    {
        return $this->setData(self::COMPLEMENT, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getNeighborhood(): string
    {
        return $this->getData(self::NEIGHBORHOOD);
    }

    /**
     * {@inheritDoc}
     */
    public function setNeighborhood(string $value): AddressObjectInterface
    {
        return $this->setData(self::NEIGHBORHOOD, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCity(): string
    {
        return $this->getData(self::CITY);
    }

    /**
     * {@inheritDoc}
     */
    public function setCity(string $value): AddressObjectInterface
    {
        return $this->setData(self::CITY, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getRegionCode(): string
    {
        return $this->getData(self::REGION_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function setRegionCode(string $value): AddressObjectInterface
    {
        return $this->setData(self::REGION_CODE, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCityCode(): string
    {
        return $this->getData(self::CITY_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function setCityCode(string $value): AddressObjectInterface
    {
        return $this->setData(self::CITY_CODE, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getCallingCode(): string
    {
        return $this->getData(self::CALLING_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function setCallingCode(string $value): AddressObjectInterface
    {
        return $this->setData(self::CALLING_CODE, $value);
    }

    /**
     * @inheritDoc
     */
    public function getCountry(): string|null
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * @inheritDoc
     */
    public function setCountry(string $value): AddressObjectInterface
    {
        return $this->setData(self::COUNTRY, $value);
    }

    /**
     * @inheritDoc
     */
    public function getRegionId(): string|null
    {
        return $this->getData(self::REGION_ID);
    }

    /**
     * @inheritDoc
     */
    public function setRegionId(string $value): AddressObjectInterface
    {
        return $this->setData(self::REGION_ID, $value);
    }


}
