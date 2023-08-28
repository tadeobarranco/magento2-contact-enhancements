<?php declare(strict_types=1);

namespace Barranco\Contact\Controller\Adminhtml\Inbox;

use Barranco\Contact\Api\ContactRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Barranco\Contact\Api\Data\ContactInterface;
use Barranco\Contact\Api\Data\ReplyInterface;
use Barranco\Contact\Api\ReplyRepositoryInterface;
use Barranco\Contact\Model\Mail;
use Barranco\Contact\Model\ReplyFactory;
use Psr\Log\LoggerInterface;

class Reply extends Action implements HttpPostActionInterface
{
    const STATUS = 'replied';

    private PageFactory $pageFactory;

    private JsonFactory $resultJsonFactory;

    private RawFactory $resultRawFactory;

    private DataPersistorInterface $dataPersistor;

    private ReplyFactory $replyFactory;

    private ReplyRepositoryInterface $replyRepository;

    private Mail $mail;

    private ContactRepositoryInterface $contactRepository;

    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param JsonFactory $resultJsonFactory
     * @param RawFactory $resultRawFactory
     * @param DataPersistorInterface $dataPersistor
     * @param ReplyFactory $replyFactory
     * @param ReplyRepositoryInterface $replyRepository
     * @param Mail $mail
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        JsonFactory $resultJsonFactory,
        RawFactory $resultRawFactory,
        DataPersistorInterface $dataPersistor,
        ReplyFactory $replyFactory,
        ReplyRepositoryInterface $replyRepository,
        Mail $mail,
        ContactRepositoryInterface $contactRepository,
        LoggerInterface $logger
    ) {
        $this->pageFactory = $pageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory = $resultRawFactory;
        $this->dataPersistor = $dataPersistor;
        $this->replyFactory = $replyFactory;
        $this->replyRepository = $replyRepository;
        $this->mail = $mail;
        $this->contactRepository = $contactRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Add reply to inbox comment
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        try {
            $inboxId = $this->getRequest()->getParam('id');
            $data = $this->getRequest()->getPost('reply');
            $inbox = $this->dataPersistor->get('contact_inbox');

            if ($data['comment'] === null || $data['comment'] === '') {
                throw new LocalizedException(__('The comment is missing. Enter and try again.'));
            }

            if ($inboxId !== $inbox->getId()) {
                throw new \Exception('Cannot add new comment');
            }

            $data['parent_id'] = $inboxId;

            $this->sendEmail($inbox, $data);
            $this->saveReply($data);

            $inbox->setStatus(self::STATUS);

            try {
                $this->contactRepository->save($inbox);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }

            $resultPage = $this->pageFactory->create();
            $response = $resultPage->getLayout()->getBlock('reply_contact')->toHtml();
        } catch (LocalizedException $e) {
            $response = ['error' => true, 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            $response = ['error' => true, 'message' => __($e->getMessage())];
        }

        if (is_array($response)) {
            $result = $this->resultJsonFactory->create();
            $result->setData($response);
        } else {
            $result = $this->resultRawFactory->create();
            $result->setContents($response);
        }

        return $result;
    }

    /**
     * Save reply
     *
     * @param array $data
     * @return ReplyInterface
     * @throws CouldNotSaveException
     */
    private function saveReply(array $data): ReplyInterface
    {
        $reply = $this->replyFactory->create();
        $reply->setData($data);

        return $this->replyRepository->save($reply);
    }

    /**
     * @param ContactInterface $contactInbox
     * @param array $data
     * @return void
     */
    private function sendEmail(ContactInterface $contactInbox, array $data): void
    {
        $this->mail->send($contactInbox, $data);
    }
}
