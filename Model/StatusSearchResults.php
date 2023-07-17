<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\Data\StatusSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

class StatusSearchResults extends SearchResults implements StatusSearchResultsInterface
{
}
