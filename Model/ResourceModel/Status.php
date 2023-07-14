<?php declare(strict_types=1);

namespace Barranco\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Status extends AbstractDb
{
    private const STATUS_TABLE_NAME = 'contact_form_status';

    /**
     * @inheirtdoc
     */
    protected function _construct()
    {
        $this->_init(self::STATUS_TABLE_NAME, 'status');
    }
}
