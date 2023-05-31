<?php

namespace TheITNerd\Brasil\Api;

/**
 * Interface PostcodeSearchInterface
 * @package TheITNerd\Brasil\Api
 */
interface PostcodeSearchInterface
{
    /**
     * Search address from a postcode
     * @return array
     */
    public function searchAddress(): array;

    /**
     * Search postcode from an Address
     * @return array
     */
    public function searchPostcode(): array;
}
