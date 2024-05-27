<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

class CompositeConfigProvider implements ConfigProviderInterface
{
    private array $configProviders;

    /**
     * Class constructor
     *
     * @param array $configProviders
     */
    public function __construct(
        array $configProviders
    ) {
        $this->configProviders = $configProviders;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(): array
    {
        $config = [];

        foreach ($this->configProviders as $configProvider) {
            $config = array_merge_recursive($config, $configProvider->getConfig());
        }

        return $config;
    }
}
