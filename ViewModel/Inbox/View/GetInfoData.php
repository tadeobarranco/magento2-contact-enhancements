<?php declare(strict_types=1);

namespace Barranco\Contact\ViewModel\Inbox\View;

use Barranco\Contact\Api\Data\ContactInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class GetInfoData implements ArgumentInterface
{
    private DataPersistorInterface $dataPersistor;

    /**
     * Class constructor
     *
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * Get Inbox Data
     *
     * @return ContactInterface|null
     */
    public function getInboxData(): ?ContactInterface
    {
        return $this->dataPersistor->get('contact_inbox');
    }
}
