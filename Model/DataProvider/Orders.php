<?php declare(strict_types=1);

namespace Barranco\Contact\Model\DataProvider;

use Magento\Search\Model\Autocomplete\DataProviderInterface;

class Orders implements DataProviderInterface
{
    /**
     * @return array
     */
    public function getItems(): array
    {
        return [];
    }
}
