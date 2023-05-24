<?php declare(strict_types=1);

namespace Barranco\Contact\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Barranco\Contact\Model\ResourceModel\Contact\Collection;
use Barranco\Contact\Model\ResourceModel\Contact\CollectionFactory;

class Contact extends AbstractDataProvider
{
    /**
     * @var Collection $collection
     */
    protected $collection;

    /**
     * @var array
     */
    private array $loadedData = [];

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        foreach ($this->collection->getItems() as $item) {
            $this->loadedData[$item->getData('id')] = $item->getData();
        }

        return $this->loadedData;
    }
}

