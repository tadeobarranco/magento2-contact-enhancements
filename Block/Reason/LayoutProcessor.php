<?php declare(strict_types=1);

namespace Barranco\Contact\Block\Reason;

class LayoutProcessor implements LayoutProcessorInterface
{
    /**
     * @inheirtDoc
     */
    public function process(array $jsLayout): array
    {
        if (isset(
            $jsLayout['components']['contact']['children']['steps']['children']
            ['reason-step']['children']
        )) {
            $jsLayout['components']['contact']['children']['steps']['children']
            ['reason-step']['children']['reason-form-fields'] = [
                'component' => 'uiComponent',
                'displayArea' => 'additional-reason-form-fields',
                'children' => $this->getReasonFields()
            ];
        }

        return $jsLayout;
    }

    /**
     * Populate fields based on the contact reason
     *
     * @return array
     */
    private function getReasonFields(): array
    {
        $fields = [];
        $baseFieldComponent = $this->getBaseFieldComponent();
        $reasonsFields = array_merge(
            $this->getOrdersFields(),
            $this->getPromotionsFields(),
            $this->getProductsFields(),
        );
        $sortOrder = 2;

        foreach ($reasonsFields as $field => $label) {
            $fields[$field] = array_merge($baseFieldComponent, [
                'dataScope' => "contactReason.$field",
                'label' => $label,
                'sortOrder' => $sortOrder
            ]);
            $sortOrder++;
        }

        return $fields;
    }

    /**
     * Get base field component configurations
     *
     * @return array
     */
    private function getBaseFieldComponent(): array
    {
        return [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'contactReasonForm',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'visible' => false
            ],
            'provider' => 'contactProvider',
            'validation' => [
                'required-entry' => true,
            ]
        ];
    }

    /**
     * Get predefined fields for the orders contact reason
     *
     * @return array
     */
    private function getOrdersFields(): array
    {
        return [
            'order_id' => __('Order ID'),
            'order_status' => __('Order Status'),
            'issue_type' => __('Issue Type'),
            'shipping_carrier' => __('Shipping Carrier'),
            'tracking_number' => __('Tracking Number')
        ];
    }

    /**
     * Get predefined fields for the promotions contact reason
     *
     * @return array
     */
    private function getPromotionsFields(): array
    {
        return [
            'promotion_code' => __('Promotion Code'),
            'issue_type' => __('Issue Type'),
            'expected_discount' => __('Expected Discount'),
            'applied_discount' => __('Applied Discount'),
            'promotion_start_date' => __('Promotion Start Date'),
            'promotion_end_date' => __('Promotion End Date'),
            'cart_total' => __('Cart Total')
        ];
    }

    /**
     * Get predefined fields for the products contact reason
     *
     * @return array
     */
    private function getProductsFields(): array
    {
        return [
            'product_sku' => __('Product SKU'),
            'issue_type' => __('Issue Type'),
            'product_condition' => __('Product Condition')
        ];
    }
}
