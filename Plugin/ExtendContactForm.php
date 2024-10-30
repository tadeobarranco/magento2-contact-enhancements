<?php declare(strict_types=1);

namespace Barranco\Contact\Plugin;

use Magento\Contact\Block\ContactForm;

class ExtendContactForm
{
    private array $layoutProcessors;

    /**
     * Class constructor
     *
     * @param array $layoutProcessors
     */
    public function __construct(
        array $layoutProcessors = []
    ) {
        $this->layoutProcessors = $layoutProcessors;
    }

    /**
     * Modify the js layout object
     *
     * @param ContactForm $subject
     * @param $result
     * @return string
     */
    public function afterGetJsLayout(
        ContactForm $subject,
        $result
    ): string {
        $jsLayout = json_decode($result, true);

        foreach ($this->layoutProcessors as $processor) {
            $jsLayout = $processor->process($jsLayout);
        }

        return json_encode($jsLayout);
    }
}
