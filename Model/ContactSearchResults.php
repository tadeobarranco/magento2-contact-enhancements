<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Magento\Framework\Api\SearchResults;
use Barranco\Contact\Api\Data\ContactSearchResultsInterface;

class ContactSearchResults extends SearchResults implements ContactSearchResultsInterface
{
}
