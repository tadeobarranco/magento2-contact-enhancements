<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Barranco\Contact\Api\ContactRepositoryInterface;
use Barranco\Contact\Api\Data\ContactInterface;
use Barranco\Contact\Api\Data\ContactSearchResultsInterface;
use Barranco\Contact\Api\Data\ContactSearchResultsInterfaceFactory;
use Barranco\Contact\Model\ContactFactory;
use Barranco\Contact\Model\ResourceModel\Contact as ContactResourceModel;
use Barranco\Contact\Model\ResourceModel\Contact\Collection;
use Barranco\Contact\Model\ResourceModel\Contact\CollectionFactory;

class ContactRepository implements ContactRepositoryInterface
{
    private ContactFactory $contactFactory;

    private ContactResourceModel $contactResourceModel;

    private CollectionFactory $collectionFactory;

    private ContactSearchResultsInterfaceFactory $searchResultsFactory;

    private CollectionProcessorInterface $collectionProcessor;

    /**
     * Class constructor
     *
     * @param \Barranco\Contact\Model\ContactFactory $contactFactory
     * @param \Barranco\Contact\Model\ResourceModel\Contact $contactResourceModel
     * @param \Barranco\Contact\Model\ResourceModel\Contact\CollectionFactory $collectionFactory
     * @param \Barranco\Contact\Api\Data\ContactSearchResultsInterfaceFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ContactFactory $contactFactory,
        ContactResourceModel $contactResourceModel,
        CollectionFactory $collectionFactory,
        ContactSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->contactFactory = $contactFactory;
        $this->contactResourceModel = $contactResourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save(ContactInterface $contact): ContactInterface
    {
        try {
            $this->contactResourceModel->save($contact);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $contact;
    }

    /**
     * @inheritdoc
     */
    public function getById(int $id): ContactInterface
    {
        $contact = $this->contactFactory->create();

        $this->contactResourceModel->load($contact, $id);

        if (!$contact->getId()) {
            throw new NoSuchEntityException(__('The contact inbox with the "%1" ID doesn\'t exist.', $id));
        }

        return $contact;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ContactSearchResultsInterface
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
     * @inheritdoc
     */
    public function deleteById(int $id): bool
    {
        $contact = $this->getById($id);

        try {
            $this->contactResourceModel->delete($contact);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }
}
