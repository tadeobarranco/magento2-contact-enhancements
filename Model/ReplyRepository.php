<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Barranco\Contact\Api\Data\ReplyInterface;
use Barranco\Contact\Api\Data\ReplySearchResultsInterface;
use Barranco\Contact\Api\Data\ReplySearchResultsInterfaceFactory;
use Barranco\Contact\Api\ReplyRepositoryInterface;
use Barranco\Contact\Model\ReplyFactory;
use Barranco\Contact\Model\ResourceModel\Reply as ReplyResourceModel;
use Barranco\Contact\Model\ResourceModel\Reply\CollectionFactory;

class ReplyRepository implements ReplyRepositoryInterface
{
    private ReplyResourceModel $replyResourceModel;

    private ReplyFactory $replyFactory;

    private CollectionFactory $collectionFactory;

    private CollectionProcessorInterface $collectionProcessor;

    private ReplySearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @param ReplyResourceModel $replyResourceModel
     * @param ReplyFactory $replyFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ReplySearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ReplyResourceModel $replyResourceModel,
        ReplyFactory $replyFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        ReplySearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->replyResourceModel = $replyResourceModel;
        $this->replyFactory = $replyFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @inheirtdoc
     */
    public function save(ReplyInterface $reply): ReplyInterface
    {
        try {
            $this->replyResourceModel->save($reply);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $reply;
    }

    /**
     * @inheirtdoc
     */
    public function getById(int $id): ReplyInterface
    {
        $reply = $this->replyFactory->create();

        $this->replyResourceModel->load($reply, $id);

        if (!$reply->getId()) {
            throw new NoSuchEntityException(__('The reply inbox with the "%1" ID doesn\'t exist.', $id));
        }

        return $reply;
    }

    /**
     * @inheirtdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ReplySearchResultsInterface
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
     * @inheirtdoc
     */
    public function deleteById(int $id): bool
    {
        $reply = $this->getById($id);

        try {
            $this->replyResourceModel->delete($reply);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }
}
