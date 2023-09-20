<?php

declare(strict_types=1);

namespace TheITNerd\Brasil\Model\Resolver;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use TheITNerd\Brasil\Api\Data\BrazilCountyRepositoryInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;

/**
 * Class BrazilCounties
 * @package TheITNerd\Brasil\Model\Resolver
 */
class BrazilCounties implements ResolverInterface
{
    /**
     * @param BrazilCountyRepositoryInterface $brazilCountyRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        private readonly BrazilCountyRepositoryInterface $brazilCountyRepository,
        private readonly SearchCriteriaBuilder           $searchCriteriaBuilder
    ) {
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     */
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        $filters = $args['filters'] ?? [];

        foreach ($filters as $filter) {
            foreach ($filter['filter'] as $condition => $value) {
                $this->searchCriteriaBuilder->addFilter($filter['field'], $value, $condition);
            }
        }

        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->brazilCountyRepository->getList($searchCriteria)->getItems();
    }
}
