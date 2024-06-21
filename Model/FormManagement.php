<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\FormManagementInterface;
use Magento\Contact\Model\MailInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class FormManagement implements FormManagementInterface
{
    private LoggerInterface $logger;

    private MailInterface $mail;

    /**
     * Class constructor
     *
     * @param LoggerInterface $logger
     * @param MailInterface $mail
     */
    public function __construct(
        LoggerInterface $logger,
        MailInterface $mail
    ) {
        $this->logger = $logger;
        $this->mail = $mail;
    }

    /**
     * @inheritDoc
     */
    public function submit(
        \Barranco\Contact\Api\Data\FormDataInterface $formData
    ): bool {
        $data = $formData->getData();
        try {
            $this->sendEmail($this->validateFormData($data));
        } catch (LocalizedException $e) {
            $this->logger->critical($e->getMessage());
            throw new CouldNotSaveException(
                __($e->getMessage()),
                $e
            );
        }

        return true;
    }

    /**
     * Validate form data
     *
     * @param array $data
     * @return array
     * @throws LocalizedException
     */
    private function validateFormData(array $data): array
    {
        if (trim($data['name']) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }

        if (trim($data['comment']) === '') {
            throw new LocalizedException(__('What\'s\ on your mind? Enter any comment and try again.'));
        }

        if (!str_contains($data['email'], '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify it and try again.'));
        }

        return $data;
    }

    /**
     * Method to send email as the Magento core
     *
     * @param array $data
     * @return void
     */
    private function sendEmail(array $data): void
    {
        $this->mail->send(
            $data['email'],
            ['data' => new DataObject($data)]
        );
    }
}
