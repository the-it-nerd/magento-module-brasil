<?php

namespace TheITNerd\Brasil\Model\Clients\ViaCEP;

use Exception;
use Magento\Directory\Model\Region;
use Magento\Directory\Model\RegionFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\HTTP\Client\Curl;
use TheITNerd\Core\Model\DataObjects\AddressObjectFactory;
use TheITNerd\Core\Api\Adapters\PostcodeClientInterface;
use TheITNerd\Core\Api\Objects\AddressObjectInterface;

/**
 * Class ViaCEPClient
 * @package TheITNerd\Brasil\Model\Clients\ViaCEP
 */
class ViaCEPClient implements PostcodeClientInterface
{
    public const API_URL = "https://viacep.com.br/ws/";
    public const API_ADDRESS_ENDPOINT = "{postcode}/json/";
    public const API_POSTCODE_ENDPOINT = "{region}/{city}/{street}/json/";

    /**
     * @param Curl $httpClient
     * @param AddressObjectFactory $addressObjectFactory
     * @param RegionFactory $regionFactory
     */
    public function __construct(
        private readonly Curl                 $httpClient,
        private readonly AddressObjectFactory $addressObjectFactory,
        private readonly RegionFactory        $regionFactory
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getLabel(): string
    {
        return 'ViaCEP Client - Brasil only';
    }

    /**
     * @inheritDoc
     */
    public function searchAddress(string $postcode): AddressObjectInterface|null
    {
        $url = str_replace('{postcode}', rawurlencode($postcode), self::API_URL . self::API_ADDRESS_ENDPOINT);
        $this->httpClient->get($url);

        if ($this->httpClient->getStatus() === 200) {

            $data = json_decode($this->httpClient->getBody(), true);

            if (!isset($data['erro'])) {
                return $this->viaCEPAddressToDataObject($data);
            }
        }

        return null;
    }

    /**
     * @param array $data
     * @return AddressObjectInterface
     * @throws NotFoundException
     */
    protected function viaCEPAddressToDataObject(array $data): AddressObjectInterface
    {
        $region = $this->getRegionByCode($data['uf']);

        return $this->addressObjectFactory->create()
            ->setCity($data['localidade'] ?? null)
            ->setCallingCode($data['ddd'] ?? null)
            ->setComplement($data['complemento'] ?? null)
            ->setNeighborhood($data['bairro'] ?? null)
            ->setStreet($data['logradouro'] ?? null)
            ->setCityCode($data['ibge'] ?? null)
            ->setPostcode($data['cep'] ?? null)
            ->setRegionCode($region->getCode())
            ->setRegionId($region->getId())
            ->setCountry($region->getCountryId());

    }

    /**
     * @param string $code
     * @return Region
     * @throws NotFoundException
     */
    protected function getRegionByCode(string $code): Region
    {
        try {
            return $this->regionFactory->create()->loadByCode($code, 'BR');
        } catch (Exception $e) {
            throw new NotFoundException(__('Region not found'));
        }
    }

    /**
     * @inheritDoc
     */
    public function searchPostcode(AddressObjectInterface $addressObject): array|null
    {
        $url = str_replace(['{region}', '{city}', '{street}'], [rawurlencode($addressObject->getRegionCode()), rawurlencode($addressObject->getCity()), rawurlencode($addressObject->getStreet())], self::API_URL . self::API_POSTCODE_ENDPOINT);
        try {
            $this->httpClient->get($url);
            $objects = [];

            foreach (json_decode($this->httpClient->getBody(), true) as $address) {
                $objects[] = $this->viaCEPAddressToDataObject($address)->toArray();
            }
            return $objects;
        } catch (Exception $e) {
            return null;
        }
    }
}
