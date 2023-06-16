<?php declare(strict_types=1);

namespace Barranco\Contact\Block\View;

use Barranco\Contact\Api\Data\ContactInterface;
use Barranco\Contact\Api\ReplyRepositoryInterface;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Reply extends Template
{
    private DataPersistorInterface $dataPersistor;

    private ReplyRepositoryInterface $replyRepository;

    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * Class constructor
     *
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param ReplyRepositoryInterface $replyRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        ReplyRepositoryInterface $replyRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->replyRepository = $replyRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * {@inheritDoc}
     */
    protected function _prepareLayout(): Reply
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

    /**
     * Get replies from inbox
     *
     * @return array
     * @throws LocalizedException
     */
    public function getReplies(): array
    {
        $inbox = $this->getInbox();
        $items = [];

        $replies = $this->replyRepository->getList(
            $this->searchCriteriaBuilder
                ->addFilter('parent_id', $inbox->getId())
                ->create()
        );

        if ($replies->getItems()) {
            foreach ($replies->getItems() as $reply) {
                $items[] = $reply->getComment();
            }
        }

        return $items;
    }
}
