<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

/**
 * Reason Details Interface
 * @api
 * @since 100.0.0
 */
interface ReasonDetailsInterface
{
    const REASON = 'reason';

    /**
     * @return string
     */
    public function getReason();

    /**
     * @param string $reason
     * @return $this
     */
    public function setReason($reason);
}

