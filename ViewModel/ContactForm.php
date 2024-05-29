<?php declare(strict_types=1);

namespace Barranco\Contact\ViewModel;

use Barranco\Contact\Model\CompositeConfigProvider;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ContactForm implements ArgumentInterface
{
    private CompositeConfigProvider $configProvider;

    private SerializerInterface $serializer;

    /**
     * Class constructor
     *
     * @param CompositeConfigProvider $configProvider
     * @param SerializerInterface $serializer
     */
    public function __construct(
        CompositeConfigProvider $configProvider,
        SerializerInterface $serializer
    ) {
        $this->configProvider = $configProvider;
        $this->serializer = $serializer;
    }

    /**
     * Get configuration
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->configProvider->getConfig();
    }

    /**
     * Get serialized configuration
     *
     * @return bool|string
     */
    public function getSerializedConfig(): bool|string
    {
        return $this->serializer->serialize($this->getConfig());
    }
}
