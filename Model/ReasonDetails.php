<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\Data\ReasonDetailsInterface;
use Magento\Framework\Model\AbstractModel;

class ReasonDetails extends AbstractModel implements ReasonDetailsInterface
{
    /**
     * @inheritDoc
     */
    public function getReason()
    {
        return $this->getData(self::REASON);
    }

    /**
     * @inheritDoc
     */
    public function setReason($reason)
    {
        return $this->setData(self::REASON, $reason);
    }
}
