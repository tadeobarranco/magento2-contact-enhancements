<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\AutocompleteInterface;
use Magento\Framework\App\RequestInterface;

class Autocomplete implements AutocompleteInterface
{
    private RequestInterface $request;

    private array $dataProviders;

    /**
     * Class constructor
     *
     * @param RequestInterface $request
     * @param array $dataProviders
     */
    public function __construct(
        RequestInterface $request,
        array $dataProviders = []
    ) {
        $this->request = $request;
        $this->dataProviders = $dataProviders;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        $reason = $this->request->getParam('reason');
        $data = $this->dataProviders[$reason]->getItems();

        return array_merge([], ...$data);
    }
}
