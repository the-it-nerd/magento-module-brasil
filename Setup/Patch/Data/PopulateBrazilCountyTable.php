<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Setup\Patch\Data;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterface;
use TheITNerd\Brasil\Api\Data\BrazilCountyRepositoryInterface;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterfaceFactory;

/**
 * Data patch to insert data in brazil_county table
 */
class PopulateBrazilCountyTable implements DataPatchInterface
{
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param Curl $curl
     * @param BrazilCountyRepositoryInterface $brazilCountyRepository
     * @param BrazilCountyInterfaceFactory $brazilCountyFactory
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly Curl $curl,
        private readonly BrazilCountyRepositoryInterface $brazilCountyRepository,
        private readonly BrazilCountyInterfaceFactory $brazilCountyFactory
    ) {
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     * @throws CouldNotSaveException
     */
    public function apply(): self
    {
        $this->moduleDataSetup->startSetup();

        $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/municipios?view=nivelado';

        $this->curl->get($url);
        $response = $this->curl->getBody();

        $data = json_decode($response, true);

        foreach ($data as $county) {
            /** @var $brazilCounty BrazilCountyInterface */
            $brazilCounty = $this->brazilCountyFactory->create();

            $brazilCounty->setCountyId($county['municipio-id'])
                ->setCountyName($county['municipio-nome'])
                ->setMicroregionId($county['microrregiao-id'])
                ->setMicroregionName($county['microrregiao-nome'])
                ->setMesoregionId($county['mesorregiao-id'])
                ->setMesoregionName($county['mesorregiao-nome'])
                ->setImmediateRegionId($county['regiao-imediata-id'])
                ->setImmediateRegionName($county['regiao-imediata-nome'])
                ->setIntermediateRegionId($county['regiao-intermediaria-id'])
                ->setIntermediateRegionName($county['regiao-intermediaria-nome'])
                ->setStateId($county['UF-id'])
                ->setStateCode($county['UF-sigla'])
                ->setStateName($county['UF-nome'])
                ->setRegionId($county['regiao-id'])
                ->setRegionCode($county['regiao-sigla'])
                ->setRegionName($county['regiao-nome']);

            $this->brazilCountyRepository->save($brazilCounty);
        }

        $this->moduleDataSetup->endSetup();

        return $this;
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * Example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases(): array
    {
        return [];
    }
}
