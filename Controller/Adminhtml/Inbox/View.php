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

class View extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Barranco_Contact::view';

    private PageFactory $pageFactory;

    private ContactRepositoryInterface $contactRepository;

    private RedirectFactory $redirectFactory;

    private DataPersistorInterface $dataPersistor;

    /**
     * Class constructor
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param ContactRepositoryInterface $contactRepository
     * @param RedirectFactory $redirectFactory
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ContactRepositoryInterface $contactRepository,
        RedirectFactory $redirectFactory,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->contactRepository = $contactRepository;
        $this->redirectFactory = $redirectFactory;
        $this->dataPersistor = $dataPersistor;
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
