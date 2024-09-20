<?php declare(strict_types=1);

namespace Barranco\Contact\Controller\Search;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Reason extends Action implements HttpGetActionInterface
{
    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $responseData = [];
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($responseData);

        return $resultJson;
    }
}
