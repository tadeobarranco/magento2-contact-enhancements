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
            ['reason-step']['children']['contact-reason-fieldset']['children']
        )) {
            $jsLayout['components']['contact']['children']['steps']['children']
            ['reason-step']['children']['contact-reason-fieldset']['children']
            ['form-fields'] = [
                'component' => 'uiComponent',
                'displayArea' => 'additional-form-fields',
                'children' => [
                    'order_number' => [
                        'component' => 'Magento_Ui/js/form/element/abstract',
                        'config' => [
                            'customScope' => 'contactReasonForm',
                            'template' => 'ui/form/field',
                            'elementTmpl' => 'ui/form/element/input',
                        ],
                        'dataScope' => 'contactReasonForm.order_number',
                        'label' => __('Order Number'),
                        'provider' => 'contactProvider',
                        'sortOrder' => 2,
                        'validation' => [
                            'required-entry' => false,
                        ]
                    ]
                ]
            ];
        }

        return $jsLayout;
    }
}
