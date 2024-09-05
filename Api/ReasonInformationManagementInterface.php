<?php declare(strict_types=1);

namespace Barranco\Contact\Api;

use Barranco\Contact\Api\Data\ReasonDetailsInterface;

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
     * @return ReasonDetailsInterface
     */
    public function getReasonInformation(string $category): ReasonDetailsInterface;
}
