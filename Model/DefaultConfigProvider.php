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
        $config['labelsByIssueType'] = $this->getLabelsByIssueType();

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
                'order_id' => __('Order ID'),
                'order_status' => __('Order Status'),
                'order_issue_type' => __('Issue Type'),
                'shipping_carrier' => __('Shipping Carrier'),
                'tracking_number' => __('Tracking Number')
            ],
            'promotions' => [
                'promotion_code' => __('Promotion Code'),
                'promotion_issue_type' => __('Issue Type'),
                'expected_discount' => __('Expected Discount'),
                'applied_discount' => __('Applied Discount'),
                'promotion_start_date' => __('Promotion Start Date'),
                'promotion_end_date' => __('Promotion End Date'),
                'cart_total' => __('Cart Total')
            ],
            'products' => [
                'product_sku' => __('Product SKU'),
                'product_issue_type' => __('Issue Type'),
                'product_condition' => __('Product Condition')
            ]
        ];
    }

    /**
     * Get the labels for the issue types
     *
     * @return array
     */
    private function getLabelsByIssueType(): array
    {
        return [
            'shipping_delay' => __( 'Shipping Delay'),
            'wrong_items' => __( 'Wrong Items'),
            'missing_items' => __( 'Missing Items'),
            'damaged_items' => __( 'Damaged Items'),
            'cancellation_request' => __( 'Cancellation Request'),
            'coupon_issue' => __( 'Coupon Issue'),
            'discount_not_applied' => __( 'Discount Not Applied'),
            'promotion_expired' => __( 'Promotion Expired'),
            'eligibility_question' => __( 'Eligibility Question'),
            'availability_query' => __( 'Availability Query'),
            'technical_specification' => __( 'Technical Specification'),
            'compatibility_question' => __( 'Compatibility Question'),
            'quality_issue' => __( 'Quality Issue')
        ];
    }
}
