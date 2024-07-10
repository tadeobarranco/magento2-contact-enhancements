<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class DefaultConfigProvider implements ConfigProviderInterface
{
    private StoreManagerInterface $storeManager;

    private UrlInterface $urlBuilder;

    /**
     * Class constructor
     *
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        UrlInterface $urlBuilder
    ) {
        $this->storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(): array
    {
        $config = [];
        $config['storeCode'] = $this->getStoreCode();
        $config['defaultSuccessPageUrl'] = $this->getDefaultSuccessPageUrl();

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

    /**
     * Get success page URL
     *
     * @return string
     */
    private function getDefaultSuccessPageUrl(): string
    {
        return $this->urlBuilder->getUrl('contact');
    }
}
