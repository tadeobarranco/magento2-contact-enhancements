<?php declare(strict_types=1);

namespace Barranco\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contact extends AbstractDb
{
    private const CONTACT_TABLE_NAME = 'contact_form_inbox';
    
    /**
     * Initialize with table name and primary field
     */
    protected function _construct()
    {
        $this->_init(self::CONTACT_TABLE_NAME, 'id');
    }
}
