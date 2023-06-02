<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\Data\ReplyInterface;
use Barranco\Contact\Model\ResourceModel\Reply as ReplySourceModel;
use Magento\Framework\Model\AbstractModel;

class Reply extends AbstractModel implements ReplyInterface
{
    /**
     * @inheridoc
     */
    protected function _construct()
    {
        $this->_init(ReplySourceModel::class);
    }

    /**
     * @inheridoc
     */
    public function getParentId()
    {
        return $this->getData(self::PARENT_ID);
    }

    /**
     * @inheridoc
     */
    public function setParentId($parentId)
    {
        return $this->setData(self::PARENT_ID, $parentId);
    }

    /**
     * @inheridoc
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @inheridoc
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * @inheridoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
}
