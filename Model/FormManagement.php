<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\FormManagementInterface;

class FormManagement implements FormManagementInterface
{
    /**
     * @inheritDoc
     */
    public function submit(): bool
    {
        return true;
    }
}
