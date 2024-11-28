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
     * @param UrlInterface $urlBuilder
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
        $config['fieldsByReason'] = $this->getFieldsByReason();

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

    /**
     * Get the list of fields available per reason
     *
     * @return array[]
     */
    private function getFieldsByReason(): array
    {
        return [
            'orders' => [
                'order_id',
                'order_status',
                'issue_type',
                'shipping_carrier',
                'tracking_number',
            ],
            'promotions' => [
                'promotion_code',
                'issue_type',
                'expected_discount',
                'applied_discount',
                'promotion_start_date',
                'promotion_end_date',
                'cart_total'
            ],
            'products' => [
                'product_sku',
                'issue_type',
                'product_condition'
            ]
        ];
    }
}
