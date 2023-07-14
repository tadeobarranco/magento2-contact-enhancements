<?php declare(strict_types=1);

namespace Barranco\Contact\Model\ResourceModel\Status;

use Barranco\Contact\Model\Status;
use Barranco\Contact\Model\ResourceModel\Status as StatusResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @inheirtdoc
     */
    protected function _construct()
    {
        $this->_init(Status::class, StatusResourceModel::class);
    }
}
