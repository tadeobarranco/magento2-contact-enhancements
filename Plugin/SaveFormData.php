<?php declare(strict_types=1);

namespace Barranco\Contact\Plugin;

use Psr\Log\LoggerInterface;
use Magento\Contact\Model\MailInterface;

class SaveFormData
{
    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Save contact form before send email
     *
     * @param \Magento\Contact\Model\MailInterface $subject
     * @param string $replyTo
     * @param array $variables
     */
    public function beforeSend(MailInterface $subject, $replyTo, array $variables)
    {
        $this->logger->info('Save contact form before send email');

        return [$replyTo, $variables];
    }
}
