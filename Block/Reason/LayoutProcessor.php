<?php declare(strict_types=1);

namespace Barranco\Contact\Block\Reason;

class LayoutProcessor implements LayoutProcessorInterface
{
    private array $dropdowns = [
        'order_issue_type',
        'promotion_issue_type',
        'product_issue_type'
    ];

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
        $dropdownFieldComponent = $this->getDropdownFieldComponent();
        $specialFieldComponent = $this->getSpecialFieldComponent();
        $reasonsFields = array_merge(
            $this->getOrdersFields(),
            $this->getPromotionsFields(),
            $this->getProductsFields(),
        );
        $sortOrder = 2;

        foreach ($reasonsFields as $field => $label) {
            $component = in_array($field, $this->dropdowns) ?
                $dropdownFieldComponent : $baseFieldComponent;

            $fields[$field] = array_merge($component, [
                'dataScope' => "contactReasonForm.$field",
                'label' => $label,
                'sortOrder' => $sortOrder
            ]);

            if (isset($specialFieldComponent[$field])) {
                if (isset($specialFieldComponent[$field]['config'])) {
                    $fields[$field]['config'] = array_merge(
                        $fields[$field]['config'],
                        $specialFieldComponent[$field]['config']
                    );
                } else {
                    $fields[$field] = array_merge($fields[$field], $specialFieldComponent[$field]);
                }
            }

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
     * Get dropdown field component configurations
     *
     * @return array
     */
    private function getDropdownFieldComponent(): array
    {
        return [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'contactReasonForm',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'caption' => '-- Please Select --',
                'visible' => false,
            ],
            'provider' => 'contactProvider',
            'validation' => [
                'required-entry' => true,
            ]
        ];
    }

    /**
     * Get spacial field component configurations
     *
     * @return array
     */
    private function getSpecialFieldComponent(): array
    {
        return [
            'order_issue_type' => [
                'config' => [
                    'options' => [
                        ['value' => 'shipping_delay', 'label' => 'Shipping Delay'],
                        ['value' => 'wrong_items', 'label' => 'Wrong Items'],
                        ['value' => 'missing_items', 'label' => 'Missing Items'],
                        ['value' => 'damaged_items', 'label' => 'Damaged Items'],
                        ['value' => 'cancellation_request', 'label' => 'Cancellation Request']
                    ],
                ],
            ],
            'shipping_carrier' => [
                'validation' => ['required-entry' => false]
            ],
            'tracking_number' => [
                'validation' => ['required-entry' => false]
            ],
            'promotion_issue_type' => [
                'config' => [
                    'options' => [
                        ['value' => 'coupon_issue', 'label' => 'Coupon Issue'],
                        ['value' => 'discount_not_applied', 'label' => 'Discount Not Applied'],
                        ['value' => 'promotion_expired', 'label' => 'Promotion Expired'],
                        ['value' => 'eligibility_question', 'label' => 'Eligibility Question']
                    ],
                ],
            ],
            'expected_discount' => [
                'validation' => ['required-entry' => false]
            ],
            'applied_discount' => [
                'validation' => ['required-entry' => false]
            ],
            'promotion_start_date' => [
                'validation' => ['required-entry' => false]
            ],
            'promotion_end_date' => [
                'validation' => ['required-entry' => false]
            ],
            'cart_total' => [
                'validation' => ['required-entry' => false]
            ],
            'product_issue_type' => [
                'config' => [
                    'options' => [
                        ['value' => 'availability_query', 'label' => 'Availability Query'],
                        ['value' => 'technical_specification', 'label' => 'Technical Specification'],
                        ['value' => 'compatibility_question', 'label' => 'Compatibility Question'],
                        ['value' => 'quality_issue', 'label' => 'Quality Issue']
                    ],
                ],
            ],
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
            'order_issue_type' => __('Issue Type'),
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
            'promotion_issue_type' => __('Issue Type'),
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
            'product_issue_type' => __('Issue Type'),
            'product_condition' => __('Product Condition')
        ];
    }
}
