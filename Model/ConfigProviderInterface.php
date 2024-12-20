<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * ConfigProviderInterface
 * @api
 * @since 100.0.0
 */
interface ConfigProviderInterface
{
    /**
     * Get contact form configurations
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getConfig(): array;
}
