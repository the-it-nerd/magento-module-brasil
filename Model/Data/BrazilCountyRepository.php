<?php
declare(strict_types=1);

namespace TheITNerd\Brasil\Model\Data;

use Magento\Framework\Api\SearchCriteriaInterface;
use TheITNerd\Brasil\Api\Data\BrazilCountyRepositoryInterface;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterface;
use TheITNerd\Brasil\Api\Data\BrazilCountyInterfaceFactory;
use TheITNerd\Brasil\Model\ResourceModel\BrazilCounty as BrazilCountyResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use TheITNerd\Brasil\Model\ResourceModel\BrazilCounty\CollectionFactory as BrazilCountyCollectionFactory;
use TheITNerd\Brasil\Model\ResourceModel\BrazilCounty\Collection as BrazilCountyCollection;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * Class BrazilCountyRepository
 */
class BrazilCountyRepository implements BrazilCountyRepositoryInterface
{
    /**
     * @param BrazilCountyResource $resource
     * @param BrazilCountyInterfaceFactory $brazilCountyFactory
     * @param BrazilCountyCollectionFactory $brazilCountyCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        private readonly BrazilCountyResource $resource,
        private readonly BrazilCountyInterfaceFactory $brazilCountyFactory,
        private readonly BrazilCountyCollectionFactory $brazilCountyCollectionFactory,
        private readonly CollectionProcessorInterface $collectionProcessor,
        private readonly SearchResultsInterfaceFactory $searchResultsFactory
    ) {
    }

    /**
     * Save Brazil County
     *
     * @param BrazilCountyInterface $brazilCounty
     * @return BrazilCountyInterface
     * @throws CouldNotSaveException
     */
    public function save(BrazilCountyInterface $brazilCounty): BrazilCountyInterface
    {
        try {
            $this->resource->save($brazilCounty);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Brazil County: %1',
                $exception->getMessage()
            ));
        }
        return $brazilCounty;
    }

    /**
     * Retrieve Brazil County by entity ID
     *
     * @param int $entityId
     * @return BrazilCountyInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $entityId): BrazilCountyInterface
    {
        $brazilCounty = $this->brazilCountyFactory->create();
        $this->resource->load($brazilCounty, $entityId);
        if (!$brazilCounty->getId()) {
            throw new NoSuchEntityException(__('Brazil County with ID "%1" does not exist.', $entityId));
        }
        return $brazilCounty;
    }

    /**
     * Delete Brazil County
     *
     * @param BrazilCountyInterface $brazilCounty
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(BrazilCountyInterface $brazilCounty): bool
    {
        try {
            $this->resource->delete($brazilCounty);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Brazil County: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete Brazil County by entity ID
     *
     * @param int $entityId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $entityId): bool
    {
        return $this->delete($this->getById($entityId));
    }

    /**
     * Retrieves Brazil County list matching the search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        /** @var BrazilCountyCollection $collection */
        $collection = $this->brazilCountyCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();

        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create()
            ->setSearchCriteria($searchCriteria)
            ->setItems($collection->getItems())
            ->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
