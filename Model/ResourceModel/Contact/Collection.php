<?php declare(strict_types=1);

namespace Barranco\Contact\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Barranco\Contact\Model\Contact;
use Barranco\Contact\Model\ResourceModel\Contact as ContactResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Define model and resource model
     */
    protected function _construct()
    {
        $this->_init(Contact::class, ContactResourceModel::class);
    }
}
