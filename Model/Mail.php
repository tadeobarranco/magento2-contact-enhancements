<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Area;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Barranco\Contact\Api\Data\ConfigInterface;
use Barranco\Contact\Api\Data\ContactInterface;

class Mail
{
    private StoreManagerInterface $storeManager;

    private StateInterface $inlineTranslation;

    private TransportBuilder $transportBuilder;

    private ConfigInterface $config;

    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param StoreManagerInterface $storeManager
     * @param StateInterface $inlineTranslation
     * @param TransportBuilder $transportBuilder
     * @param ConfigInterface $config
     * @param LoggerInterface $logger
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        ConfigInterface $config,
        LoggerInterface $logger
    ) {
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * Send email from reply contact form
     *
     * @param ContactInterface $contactInbox
     * @param array $data
     * @return void
     */
    public function send(ContactInterface $contactInbox, array $data): void
    {
        $options = [
            'area' => Area::AREA_FRONTEND,
            'store' => $this->storeManager->getStore()->getId()
        ];

        $variables = [
            'name' => $contactInbox->getName(),
            'comment' => $contactInbox->getComment(),
            'reply' => $data['comment']
        ];

        $this->inlineTranslation->suspend();

        try {
            $transport = $this->transportBuilder
                ->setTemplateIdentifier($this->config->emailTemplate())
                ->setTemplateOptions($options)
                ->setTemplateVars($variables)
                ->setFromByScope(
                    $this->config->emailSender(),
                    $this->storeManager->getStore()->getId()
                )
                ->addTo($contactInbox->getEmail())
                ->getTransport();

            $transport->sendMessage();
        } catch (LocalizedException $e) {
            $this->logger->info(__("An error occurs while sending reply email: " . $e->getMessage()));
        } finally {
            $this->inlineTranslation->resume();
        }
    }
}
