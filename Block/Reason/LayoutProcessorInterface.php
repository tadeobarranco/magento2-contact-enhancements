<?php declare(strict_types=1);

namespace Barranco\Contact\Block\Reason;

interface LayoutProcessorInterface
{
    /**
     * Process the js layout object
     *
     * @param array $jsLayout
     * @return array
     */
    public function process(array $jsLayout): array;
}
