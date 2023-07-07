<?php declare(strict_types=1);

namespace Barranco\Contact\Model\ResourceModel\Reply;

use Barranco\Contact\Model\Reply;
use Barranco\Contact\Model\ResourceModel\Reply as ReplyResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model and resource model
     */
    protected function _construct()
    {
        $this->_init(Reply::class, ReplyResourceModel::class);
    }
}
