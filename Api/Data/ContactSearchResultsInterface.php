<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for contact search results
 * @api
 * @since 100.0.0
 */
interface ContactSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get contacts list
     *
     * @return \Barranco\Contact\Api\Data\ContactInterface[]
     */
    public function getItems();

    /**
     * Set contacts list
     *
     * @param \Barranco\Contact\Api\Data\ContactInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
