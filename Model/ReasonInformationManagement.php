<?php declare(strict_types=1);

namespace Barranco\Contact\Model;

use Barranco\Contact\Api\Data\ReasonDetailsInterface;
use Barranco\Contact\Api\ReasonInformationManagementInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class ReasonInformationManagement implements ReasonInformationManagementInterface
{
    private array $allowedCategories = [
        'orders',
        'promotions',
        'products'
    ];

    private ReasonDetailsFactory $reasonDetailsFactory;

    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param ReasonDetailsFactory $reasonDetailsFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ReasonDetailsFactory $reasonDetailsFactory,
        LoggerInterface $logger
    ) {
        $this->reasonDetailsFactory = $reasonDetailsFactory;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     * @throws InputException
     */
    public function getReasonInformation(string $category): ReasonDetailsInterface
    {
        try {
            $this->validateCategory($category);

            /** @var ReasonDetailsInterface $reasonDetails */
            $reasonDetails = $this->reasonDetailsFactory->create();
            $reasonDetails->setReason($category);

            return $reasonDetails;
        } catch (LocalizedException $e) {
            $this->logger->critical($e->getMessage());
            throw new InputException(
                __(
                    'The reason information is invalid. Error: "%message"',
                    ['message' => $e->getMessage()]
                )
            );
        }
    }

    /**
     * @param string $category
     * @return void
     * @throws LocalizedException
     */
    private function validateCategory(string $category): void
    {
        if (!in_array($category, $this->allowedCategories)) {
            throw new LocalizedException(__('This category is invalid. Verify and try again'));
        }
    }
}
