<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\Data\StatusInterface;
use Barranco\Contact\Model\ResourceModel\Status as StatusResourceModel;
use Magento\Framework\Model\AbstractModel;

class Status extends AbstractModel implements StatusInterface
{
    /**
     * @inheirtdoc
     */
    protected function _construct()
    {
        $this->_init(StatusResourceModel::class);
    }

    /**
     * @inheirtdoc
     */
    public function getStatus(): ?string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @ingeritdoc
     */
    public function setStatus(string $status): StatusInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritdoc
     */
    public function getLabel(): ?string
    {
        return $this->getData(self::LABEL);
    }

    /**
     * @inheritdoc
     */
    public function setLabel(string $label): StatusInterface
    {
        return $this->setData(self::LABEL, $label);
    }
}
