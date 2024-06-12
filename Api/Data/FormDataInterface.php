<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

/**
 * Form Data Interface
 * @api
 * @since 100.0.0
 */
interface FormDataInterface
{
    const NAME = 'name';
    const EMAIL = 'email';
    const TELEPHONE = 'telephone';
    const COMMENT = 'comment';

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getTelephone();

    /**
     * @param string $telephone
     * @return $this
     */
    public function setTelephone($telephone);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment);
}
