<?php

namespace Vnext\BasicTraining\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{

    protected $postFactory;
    protected $postCollection;

    public function __construct(
        Template\Context                                                $context,
        \Vnext\BasicTraining\Model\Post                                 $postFactory, // Add your custom Model
        \Vnext\BasicTraining\Model\ResourceModel\Post\CollectionFactory $postCollection, // Add your custom Model
        array                                                           $data = []
    )
    {
        parent::__construct($context, $data);
        $this->postFactory = $postFactory;
        $this->postCollection = $postCollection;
    }

    protected function _prepareLayout()
    {
//        $this->pageConfig->getTitle()->set(__('My Custom Pagination'));
        parent::_prepareLayout();
        $page_size = $this->getPagerCount();

        $page_data = $this->getDataStudent();
        if ($this->getDataStudent()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'custom.pager.name'
            )
                ->setAvailableLimit($page_size)
                ->setShowPerPage(true)
                ->setCollection($page_data);
            $this->setChild('pager', $pager);
            $this->getDataStudent()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getDataStudent()
    {
        // get custom collection
        $collection = $this->postFactory->getCollection();
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5; // set minimum records
        // get param sort values
        $studentSort = $this->getRequest()->getParam('sort');

        // get param search values
        $studentSearchId = $this->getRequest()->getParam('entity_id');
        $studentSearchName = $this->getRequest()->getParam('name');
        $studentSearchGender = $this->getRequest()->getParam('gender');
        $studentSearchDob = $this->getRequest()->getParam('dob');

        //set data for dob
        if ($studentSearchDob) {
            $str = explode('-', $studentSearchDob);
            $dobFrom = (int)date("Y") - (int)$str[0];
            $dobTo = (int)date("Y") - (int)$str[1];
            $dobFromQuery = date_create("{$dobFrom}-01-01");
            $dobToQuery = date_create("{$dobTo}-12-31");
        }
        //Sort Student
        if ($studentSort == "id") {
            $collection->setOrder('entity_id', 'DESC');
        } else if ($studentSort == "name") {
            $collection->setOrder('name', 'DESC');
        } else if ($studentSort == "date") {
            $collection->setOrder('Dob', 'DESC');
        }

        //Search Student
        if ($studentSearchId) {
            $collection->addFieldToFilter('entity_id', $studentSearchId);
        }
        if ($studentSearchName) {
            $collection->addFieldToFilter('name', array('like' => $studentSearchName . '%'));
        }
        if ($studentSearchGender) {
            if ($studentSearchGender == 1) {
                $collection->addFieldToFilter('gender', 1);
            } else if ($studentSearchGender == "female") {
                $collection->addFieldToFilter('gender', 0);
            }
        }
        if ($studentSearchDob) {
            $collection->addFieldToFilter('dob', array('gteq' => $dobToQuery))->addFieldToFilter('dob', array('lteq' => $dobFromQuery));
        }

        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getPagerCount()
    {
        // get collection
        $minimum_show = 5; // set minimum records
        $page_array = [];
        $list_data = $this->postCollection->create();
        $list_count = ceil(count($list_data->getData()));
        $show_count = $minimum_show + 1;
        if (count($list_data->getData()) >= $show_count) {
            $list_count = $list_count / $minimum_show;
            $page_nu = $total = $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
            for ($x = 0; $x <= $list_count; $x++) {
                $total = $total + $page_nu;
                $page_array[$total] = $total;
            }
        } else {
            $page_array[$minimum_show] = $minimum_show;
            $minimum_show = $minimum_show + $minimum_show;
            $page_array[$minimum_show] = $minimum_show;
        }
        return $page_array;
    }

}
