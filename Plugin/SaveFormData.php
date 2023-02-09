<?php declare(strict_types=1);

namespace Barranco\Contact\Plugin;

use Psr\Log\LoggerInterface;
use Magento\Contact\Model\MailInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Barranco\Contact\Api\ContactRepositoryInterface;
use Barranco\Contact\Model\ContactFactory;

class SaveFormData
{
    private LoggerInterface $logger;

    private ContactFactory $contactFactory;

    private ContactRepositoryInterface $contactRepository;

    /**
     * Class constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Barranco\Contact\Model\ContactFactory $contactFactory
     * @param \Barranco\Contact\Api\ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ContactFactory $contactFactory,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->logger = $logger;
        $this->contactFactory = $contactFactory;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Save contact form before send email
     *
     * @param \Magento\Contact\Model\MailInterface $subject
     * @param string $replyTo
     * @param array $variables
     */
    public function beforeSend(MailInterface $subject, $replyTo, array $variables)
    {
        $this->logger->info('Save contact form before send email');

        $data = $variables['data']->getData();

        if (isset($data['telephone'])) {
            $data['phone'] = $data['telephone'];
            unset($data['telephone']);
        }

        $this->logger->info(print_r($data, true));

        $contact = $this->contactFactory->create();
        $contact->setData($data);

        try {
            $this->contactRepository->save($contact);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('The contact data is invalid. Verify the data and try again.')
            );
        }

        return [$replyTo, $variables];
    }
}
