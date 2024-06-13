<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\FormManagementInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class FormManagement implements FormManagementInterface
{
    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function submit(
        \Barranco\Contact\Api\Data\FormDataInterface $formData
    ): bool {
        $data = $formData->getData();
        try {
            $this->validateFormData($data);
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
}
