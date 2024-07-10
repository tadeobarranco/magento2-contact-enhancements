<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

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
     */
    public function getConfig(): array;
}
