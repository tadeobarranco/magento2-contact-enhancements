<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\ReasonInformationManagementInterface;

class ReasonInformationManagement implements ReasonInformationManagementInterface
{
    /**
     * @inheritDoc
     */
    public function getReasonInformation(string $category): bool
    {
        return true;
    }
}
