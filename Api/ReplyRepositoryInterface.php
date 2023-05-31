<?php declare(strict_types=1);

namespace Barranco\Contact\Api;

use Barranco\Contact\Api\Data\ReplyInterface;
use Barranco\Contact\Api\Data\ReplySearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Reply CRUD interface
 * @api
 * @since 100.0.0
 */
interface ReplyRepositoryInterface
{
    /**
     * Save reply
     *
     * @param ReplyInterface $reply
     * @return ReplyInterface
     * @throws CouldNotSaveException
     */
    public function save(ReplyInterface $reply): ReplyInterface;

    /**
     * Get reply by id
     *
     * @param int $id
     * @return ReplyInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): ReplyInterface;

    /**
     * Get a reply's list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReplySearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ReplySearchResultsInterface;

    /**
     * Delete reply
     *
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): bool;
}
