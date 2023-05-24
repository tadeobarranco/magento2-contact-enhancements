<?php declare(strict_types=1);

namespace Barranco\Contact\Block\View;

use Barranco\Contact\Api\Data\ContactInterface;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Request\DataPersistorInterface;

class Info extends Template
{
    private DataPersistorInterface $dataPersistor;

    /**
     * Class constructor
     *
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param array $data
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        array $data = []
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context, $data);
    }

    /**
     * {@inheritDoc}
     */
    protected function _prepareLayout(): Info
    {
        $this->addChild(
            'submit_button',
            \Magento\Backend\Block\Widget\Button::class,
            ['id' => 'submit_reply_button', 'label' => __('Submit Reply'), 'class' => 'action-secondary save']
        );
        return parent::_prepareLayout();
    }

    /**
     * Get Inbox
     *
     * @return ContactInterface|null
     */
    public function getInbox(): ?ContactInterface
    {
        return $this->dataPersistor->get('contact_inbox');
    }

    /**
     * Get form action url
     *
     * @return string
     */
    public function getSubmitUrl(): string
    {
        return $this->getUrl('*/*/reply', ['id' => $this->getInbox()->getId()]);
    }
}
