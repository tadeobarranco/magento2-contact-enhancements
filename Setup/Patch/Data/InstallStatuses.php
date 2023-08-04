<?php declare(strict_types=1);

namespace Barranco\Contact\Setup\Patch\Data;

use Barranco\Contact\Api\StatusRepositoryInterface;
use Barranco\Contact\Model\StatusFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

class InstallStatuses implements DataPatchInterface
{
    private StatusFactory $statusFactory;

    private StatusRepositoryInterface $statusRepository;

    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param StatusFactory $statusFactory
     * @param StatusRepositoryInterface $statusRepository
     */
    public function __construct(
        StatusFactory $statusFactory,
        StatusRepositoryInterface $statusRepository,
        LoggerInterface $logger
    ) {
        $this->statusFactory = $statusFactory;
        $this->statusRepository = $statusRepository;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return void
     */
    public function apply(): void
    {
        $statuses = [
            'pending' => __('Pending'),
            'viewed' => __('Viewed'),
            'replied' => __('Replied')
        ];

        $status = $this->statusFactory->create();

        foreach ($statuses as $code => $label) {
            $status->setStatus($code);
            $status->setLabel($label->getText());

            try {
                $this->statusRepository->save($status);
            } catch (\Exception $e) {
                $this->logger->info($e->getMessage());
            }
        }
    }
}
