<?php declare(strict_types=1);

namespace Barranco\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Reply extends AbstractDb
{
    private const REPLY_TABLE_NAME = 'contact_reply_inbox';

    /**
     * Initialize with table name and primary field
     */
    protected function _construct()
    {
        $this->_init(self::REPLY_TABLE_NAME, 'id');
    }
}
