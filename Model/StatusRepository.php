<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\Data\StatusInterface;
use Barranco\Contact\Api\Data\StatusSearchResultsInterface;
use Barranco\Contact\Api\Data\StatusSearchResultsInterfaceFactory;
use Barranco\Contact\Model\ResourceModel\Status as StatusResourceModel;
use Barranco\Contact\Model\ResourceModel\Status\CollectionFactory;
use Barranco\Contact\Model\StatusFactory;
use Barranco\Contact\Api\StatusRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class StatusRepository implements StatusRepositoryInterface
{
    private StatusResourceModel $statusResourceModel;

    private StatusFactory $statusFactory;

    private CollectionFactory $collectionFactory;

    private CollectionProcessorInterface $collectionProcessor;

    private StatusSearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * Repository constructor
     *
     * @param StatusResourceModel $statusResourceModel
     * @param \Barranco\Contact\Model\StatusFactory $statusFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param StatusSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        StatusResourceModel $statusResourceModel,
        StatusFactory $statusFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        StatusSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->statusResourceModel = $statusResourceModel;
        $this->statusFactory = $statusFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @inheritdoc
     */
    public function save(StatusInterface $status): StatusInterface
    {
        try {
            $this->statusResourceModel->save($status);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $status;
    }

    /**
     * @inheritdoc
     */
    public function getById(string $status): StatusInterface
    {
        $statusObject = $this->statusFactory->create();

        $this->statusResourceModel->load($statusObject, $status);

        if (!$statusObject->getStatus()) {
            throw new NoSuchEntityException(__('The status object with the "%1" status doesn\'t exist.', $status));
        }

        return $statusObject;
    }

    /**
     * @inheridoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): StatusSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheridoc
     */
    public function deleteById(string $status): bool
    {
        $statusObject = $this->getById($status);

        try {
            $this->statusResourceModel->delete($statusObject);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }
}
