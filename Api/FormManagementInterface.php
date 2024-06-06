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
     * @return bool
     */
    public function submit(): bool;
}
