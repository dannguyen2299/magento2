<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vnext\BasicTraining\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Edit CMS block action.
 */
class Sort extends \Magento\Framework\App\Action\Action
{ /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Framework\View\Result\PageFactory $resultPageFactory
)
{
    $this->resultPageFactory = $resultPageFactory;
    parent::__construct($context);
}

    public function execute()
    {
    $resultPage = $this->resultPageFactory->create();
    $resultPage->getConfig()->getTitle()->prepend(__('Sort Students'));
    return $resultPage;
    }
}
