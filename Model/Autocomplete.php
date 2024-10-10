<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\AutocompleteInterface;

class Autocomplete implements AutocompleteInterface
{
    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return [];
    }
}
