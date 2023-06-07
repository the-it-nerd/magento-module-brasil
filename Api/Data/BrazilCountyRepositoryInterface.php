<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Api\Data;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface BrazilCountyRepositoryInterface
 * @package TheITNerd\Brasil\Api\Data
 */
interface BrazilCountyRepositoryInterface
{
    /**
     * Save Brazil County
     *
     * @param BrazilCountyInterface $brazilCounty
     * @return BrazilCountyInterface
     * @throws CouldNotSaveException
     */
    public function save(BrazilCountyInterface $brazilCounty): BrazilCountyInterface;

    /**
     * Retrieve Brazil County by entity ID
     *
     * @param int $entityId
     * @return BrazilCountyInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $entityId): BrazilCountyInterface;

    /**
     * Delete Brazil County
     *
     * @param BrazilCountyInterface $brazilCounty
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(BrazilCountyInterface $brazilCounty): bool;

    /**
     * Delete Brazil County by entity ID
     *
     * @param int $entityId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $entityId): bool;

    /**
     * Retrieves Brazil County list matching the search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;
}
