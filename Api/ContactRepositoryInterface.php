<?php declare(strict_types=1);

namespace Barranco\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Barranco\Contact\Api\Data\ContactInterface;
use Barranco\Contact\Api\Data\ContactSearchResultsInterface;

/**
 * Contact CRUD Interface
 * @api
 * @since 100.0.0
 */
interface ContactRepositoryInterface
{
    /**
     * Save contact
     *
     * @param \Barranco\Contact\Api\Data\ContactInterface $contact
     * @return \Barranco\Contact\Api\Data\ContactInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(ContactInterface $contact): ContactInterface;

    /**
     * Get contact by id
     *
     * @param int $id
     * @return \Barranco\Contact\Api\Data\ContactInterface $contact
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id): ContactInterface;

    /**
     * Get a list of contacts
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Barranco\Contact\Api\Data\ContactSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ContactSearchResultsInterface;

    /**
     * Delete contact
     *
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool;
}
