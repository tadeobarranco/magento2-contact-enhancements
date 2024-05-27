<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

class DefaultConfigProvider implements ConfigProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfig(): array
    {
        return [];
    }
}
