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
     * @return StatusSearchResultsInterface[]
     */
    public function getItems(): array;

    /**
     * Set status list
     *
     * @param array $items
     * @return StatusSearchResultsInterface
     */
    public function setItems(array $items): StatusSearchResultsInterface;
}
