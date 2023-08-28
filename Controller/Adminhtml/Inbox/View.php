<?php

namespace Barranco\Contact\Controller\Adminhtml\Inbox;

use Barranco\Contact\Api\ContactRepositoryInterface;
use Barranco\Contact\Api\Data\ContactInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

class View extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Barranco_Contact::view';
    const STATUS = 'viewed';

    private PageFactory $pageFactory;

    private ContactRepositoryInterface $contactRepository;

    private RedirectFactory $redirectFactory;

    private DataPersistorInterface $dataPersistor;

    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param ContactRepositoryInterface $contactRepository
     * @param RedirectFactory $redirectFactory
     * @param DataPersistorInterface $dataPersistor
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ContactRepositoryInterface $contactRepository,
        RedirectFactory $redirectFactory,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->contactRepository = $contactRepository;
        $this->redirectFactory = $redirectFactory;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger;
    }

    /**
     * Inbox information page
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $this->dataPersistor->clear('contact_inbox');

        $inbox = $this->getInbox();

        if (!$inbox) {
            $redirect = $this->redirectFactory->create();
            $redirect->setPath('contact/index');
            return $redirect;
        }

        $inbox->setStatus(self::STATUS);

        try {
            $this->contactRepository->save($inbox);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

        $this->dataPersistor->set('contact_inbox', $inbox);

        /** @var Page $page */
        $page = $this->pageFactory->create();
        $page->setActiveMenu('Barranco_Contact::manage');
        $page->getConfig()->getTitle()->prepend(sprintf('Contact Inbox #%s', $inbox->getId()));

        return $page;
    }

    /**
     * Get contact inbox using id from request param
     *
     * @return ContactInterface|null
     */
    private function getInbox(): ?ContactInterface
    {
        try {
            $inbox = $this->contactRepository->getById($this->getRequest()->getParam('id'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
            return null;
        }

        return $inbox;
    }
}
