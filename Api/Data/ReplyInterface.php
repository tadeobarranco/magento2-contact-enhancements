<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

use Magento\Tests\NamingConvention\true\string;

/**
 * Reply Interface
 * @api
 * @since 100.0.0
 */
interface ReplyInterface
{
    const ID = 'id';
    const PARENT_ID = 'parent_id';
    const COMMENT = 'comment';
    const CREATED_AT = 'created_at';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getParentId();

    /**
     * @param int $parentId
     * @return $this
     */
    public function setParentId($parentId);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment);

    /**
     * @return string
     */
    public function getCreatedAt();
}
