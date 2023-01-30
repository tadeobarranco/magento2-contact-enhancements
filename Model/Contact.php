<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Magento\Framework\Model\AbstractModel;
use Barranco\Contact\Api\Data\ContactInterface;
use Barranco\Contact\Model\ResourceModel\Contact as ContactResourceModel;

class Contact extends AbstractModel implements ContactInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ContactResourceModel::class);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritdoc
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @inheritdoc
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * @inheritdoc
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @inheritdoc
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }
}
