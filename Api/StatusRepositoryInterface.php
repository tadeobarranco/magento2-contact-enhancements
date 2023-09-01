<?php declare(strict_types=1);

namespace Barranco\Contact\Api;

use Barranco\Contact\Api\Data\StatusInterface;
use Barranco\Contact\Api\Data\StatusSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Status CRUD Interface
 * @api
 * @since 100.0.0
 */
interface StatusRepositoryInterface
{
    /**
     * Save status
     *
     * @param StatusInterface $status
     * @return StatusInterface
     * @throws CouldNotSaveException
     */
    public function save(StatusInterface $status): StatusInterface;

    /**
     * Get status data by status primary key
     *
     * @param string $status
     * @return StatusInterface
     * @throws NoSuchEntityException
     */
    public function getById(string $status): StatusInterface;

    /**
     * Get statuses list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return StatusSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): StatusSearchResultsInterface;

    /**
     * Delete status
     *
     * @param string $status
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById(string $status): bool;
}
