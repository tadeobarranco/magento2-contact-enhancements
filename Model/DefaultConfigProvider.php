<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class DefaultConfigProvider implements ConfigProviderInterface
{
    private StoreManagerInterface $storeManager;

    /**
     * Class constructor
     *
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(): array
    {
        $config = [];
        $config['storeCode'] = $this->getStoreCode();

        return $config;
    }

    /**
     * Get store code
     *
     * @return string
     * @throws NoSuchEntityException
     */
    private function getStoreCode(): string
    {
        return $this->storeManager->getStore()->getCode();
    }
}
