<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

/**
 * Contact Status Interface
 * @api
 * @since 100.0.0
 */
interface StatusInterface
{
    const STATUS = 'status';
    const LABEL = 'label';

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @param string $status
     * @return StatusInterface
     */
    public function setStatus(string $status): StatusInterface;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $label
     * @return StatusInterface
     */
    public function setLabel(string $label): StatusInterface;
}
