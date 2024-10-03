<?php declare(strict_types=1);

namespace Barranco\Contact\Controller\Search;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Reason extends Action implements HttpGetActionInterface
{
    private array $_allowedReasons = [
        'orders',
        'promotions',
        'products'
    ];

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $reason = $this->getRequest()->getParam('reason');
        $value = $this->getRequest()->getParam('q');
        $responseData = [];
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        if (!in_array($reason, $this->_allowedReasons)) {
            $responseData = [
                'error' => true,
                'message' => __('Invalid reason category.')
            ];
        }

        if (!$value) {
            $responseData = [
                'error' => true,
                'message' => __('Missing or empty query param.')
            ];
        }

        $resultJson->setData($responseData);

        return $resultJson;
    }
}
