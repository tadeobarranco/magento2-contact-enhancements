<?php declare(strict_types=1);

namespace Barranco\Contact\Api;

/**
 * Interface for managing reason information
 * @api
 * @since 100.0.0
 */
interface ReasonInformationManagementInterface
{
    /**
     * Get reason information for specific category
     *
     * @param string $category
     * @return bool
     */
    public function getReasonInformation(string $category): bool;
}
