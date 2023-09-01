<?php declare(strict_types=1);

namespace Barranco\Contact\Ui\Component\Listing\Column\Status;

use Barranco\Contact\Api\StatusRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;
use Psr\Log\LoggerInterface;

class Options implements OptionSourceInterface
{
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    private StatusRepositoryInterface $statusRepository;

    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StatusRepositoryInterface $statusRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StatusRepositoryInterface $statusRepository,
        LoggerInterface $logger
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->statusRepository = $statusRepository;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        $options = [];
        $searchCriteria = $this->searchCriteriaBuilder->create();

        try {
            $searchResults = $this->statusRepository->getList($searchCriteria);

            foreach ($searchResults->getItems() as $item) {
                $options[] = [
                    'value' => $item['status'],
                    'label' => $item['label']
                ];
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return $options;
    }
}
