<?php declare(strict_types=1);

namespace Barranco\Contact\Api\Data;

interface ConfigInterface
{
    const XML_PATH_EMAIL_SENDER = 'contact/reply_email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE = 'contact/reply_email/email_template';

    /**
     * Return email sender
     *
     * @return string
     */
    public function emailSender(): string;

    /**
     * Return email template
     *
     * @return string
     */
    public function emailTemplate(): string;
}
