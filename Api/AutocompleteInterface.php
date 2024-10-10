<?php declare(strict_types=1);

namespace Barranco\Contact\Api;

interface AutocompleteInterface
{
    /**
     * @return array
     */
    public function getItems(): array;
}
