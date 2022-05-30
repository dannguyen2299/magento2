<?php

namespace Vnext\BasicTraining\Block;

use Magento\Framework\App\RequestInterface;

class Search extends \Magento\Framework\View\Element\Template
{
    /**
     * Request instance
     *
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;
    /** @var  \Vnext\BasicTraining\Model\PostFactory */
    protected $post_factory;
    /**
     * @param RequestInterface $request
     */
    /** @var  \Vnext\BasicTraining\Model\ResourceModel\Post\CollectionFactory */
    protected $collection_factory;

    public function __construct(
        \Vnext\BasicTraining\Model\ResourceModel\Post\CollectionFactory $collection_factory,
//        RequestInterface $request,
        \Magento\Framework\View\Element\Template\Context                $context,
        \Vnext\BasicTraining\Model\PostFactory                          $post_factory,
        array                                                           $data = [])
    {
        $this->collection_factory = $collection_factory;
        $this->post_factory = $post_factory;
//        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getDetailSearch()
    {
        $entity_id = $this->getRequest()->getPostValue('entity_id');
        $name = $this->getRequest()->getPostValue('name');
        $gender = $this->getRequest()->getPostValue('gender');
        $dob = $this->getRequest()->getPostValue('dob');
        if ($dob) {
            $str = explode('-', $dob);
            $dobFrom = (int)date("Y") - (int)$str[0];
            $dobTo = (int)date("Y") - (int)$str[1];
            $dobFromQuery = date_create("{$dobFrom}-01-01");
            $dobToQuery = date_create("{$dobTo}-12-31");
        }
        if ($entity_id) {
            $data = $this->post_factory->create()->load($entity_id);
        } else if ($name) {
            $data = $this->collection_factory->create()->addFieldToFilter('name', array('like' => $name));
        }
        if ($gender) {
            if ($gender == 1) {
                $data = $this->collection_factory->create()->addFieldToFilter('gender', 1);
            } else if ($gender == "female") {
                $data = $this->collection_factory->create()->addFieldToFilter('gender', 0);
            }
        } else if ($dob) {
            $data = $this->collection_factory->create()->addFieldToFilter('dob', array('gteq' => $dobToQuery))->addFieldToFilter('dob', array('lteq' => $dobFromQuery));
        }
        return $data;
    }
    function tableId()
    {
        $entity_id = $this->getRequest()->getPostValue('entity_id');
        $name = $this->getRequest()->getPostValue('name');
        $gender = $this->getRequest()->getPostValue('gender');
        $dob = $this->getRequest()->getPostValue('dob');
        if ($entity_id) {
            return 1;
        } else if ($name) {
            return 2;
        } else if ($gender) {
            return 3;
        }
        if ($dob) {
            return 4;
        }
    }
}
