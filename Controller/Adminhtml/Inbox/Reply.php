<?php declare(strict_types=1);

namespace Barranco\Contact\Controller\Adminhtml\Inbox;

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
use Barranco\Contact\Api\Data\ReplyInterface;
use Barranco\Contact\Api\ReplyRepositoryInterface;
use Barranco\Contact\Model\ReplyFactory;

class Reply extends Action implements HttpPostActionInterface
{
    private PageFactory $pageFactory;

    private JsonFactory $resultJsonFactory;

    private RawFactory $resultRawFactory;

    private DataPersistorInterface $dataPersistor;

    private ReplyFactory $replyFactory;

    private ReplyRepositoryInterface $replyRepository;

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
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        JsonFactory $resultJsonFactory,
        RawFactory $resultRawFactory,
        DataPersistorInterface $dataPersistor,
        ReplyFactory $replyFactory,
        ReplyRepositoryInterface $replyRepository
    ) {
        $this->pageFactory = $pageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory = $resultRawFactory;
        $this->dataPersistor = $dataPersistor;
        $this->replyFactory = $replyFactory;
        $this->replyRepository = $replyRepository;
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

            $this->saveReply($data);

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
    public function saveReply(array $data): ReplyInterface
    {
        $reply = $this->replyFactory->create();
        $reply->setData($data);

        return $this->replyRepository->save($reply);
    }
}
