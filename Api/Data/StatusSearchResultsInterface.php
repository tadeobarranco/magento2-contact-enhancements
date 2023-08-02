<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Contact Status Interface for Search Results
 * @api
 * @since 100.0.0
 */
interface StatusSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get status list
     *
     * @return \Barranco\Contact\Api\Data\StatusSearchResultsInterface[]
     */
    public function getItems();

    /**
     * Set status list
     *
     * @param \Barranco\Contact\Api\Data\StatusSearchResultsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
