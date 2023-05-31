<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for reply search results
 * @api
 * @since 100.0.0
 */
interface ReplySearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get reply list
     *
     * @return \Barranco\Contact\Api\Data\ReplyInterface[]
     */
    public function getItems();

    /**
     * Set reply list
     *
     * @param \Barranco\Contact\Api\Data\ReplyInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
