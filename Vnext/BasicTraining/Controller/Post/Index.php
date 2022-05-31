<?php

namespace Vnext\BasicTraining\Controller\Post;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }
    public function execute()
    {
        $studentSort = $this->getRequest()->getParam('sort');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultPage = $this->resultPageFactory->create();
        if ($studentSort) {
            $resultPage->getConfig()->getTitle()->set(__('Page Sort Students'));
        } else {
            $resultPage->getConfig()->getTitle()->set(__('List Students'));
        }
        return $resultPage;
    }
}
