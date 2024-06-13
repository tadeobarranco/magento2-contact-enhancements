<?php declare(strict_types=1);

namespace Barranco\Contact\Api;

/**
 * Interface for managing contact form actions
 * @api
 * @since 100.0.0
 */
interface FormManagementInterface
{
    /**
     * Submit contact form
     *
     * @param \Barranco\Contact\Api\Data\FormDataInterface $formData
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @return bool
     */
    public function submit(
        \Barranco\Contact\Api\Data\FormDataInterface $formData
    ): bool;
}
