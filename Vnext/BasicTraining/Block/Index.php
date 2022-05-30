<?php
namespace Vnext\BasicTraining\Block;

use Vnext\BasicTraining\Model\ResourceModel\Post\CollectionFactory;
class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * @var CollectionFactory
     */

    protected $postFactory;
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
                                \Vnext\BasicTraining\Model\PostFactory $postFactory)
    {
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }


    public function sayHello()
    {
        $data = $this->postFactory->create()->getCollection();
        return $data;

//        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
//        $pageSize = 5;

//        $data->addFieldToFilter('entity_id', 1);
//        $data->setOrder('entity_id','DESC');
//        $data->setPageSize($pageSize);
//        $data->setCurPage($page);


    }
}
