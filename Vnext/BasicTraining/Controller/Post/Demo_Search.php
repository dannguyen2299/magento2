<?php

namespace Vnext\BasicTraining\Controller\Post;
use Magento\Framework\Controller\ResultFactory;
class Demo_Search extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $_cacheTypeList;

    /**
     * @var \Magento\Framework\App\Cache\StateInterface
     */
    protected $_cacheState;

    /**
     * @var \Magento\Framework\App\Cache\Frontend\Pool
     */
    protected $_cacheFrontendPool;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheState = $cacheState;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->resultPageFactory = $resultPageFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * Flush cache storage
     *
     */
    public function execute()
    {
        $currentStore = $this->storeManager->getStore();
        $baseUrl = $currentStore->getBaseUrl();

//        $post = $this->getRequest()->getPostValue();
        $entity_id=$this->getRequest()->getPostValue('entity_id');
        $gender=$this->getRequest()->getPostValue('gender');
        $name=$this->getRequest()->getPostValue('name');
        $date=$this->getRequest()->getPostValue('dob');

        echo "<pre>";
        print_r($entity_id);
        echo "<pre>";

        print_r($gender);
        echo "<pre>";

        print_r($name);
        echo "<pre>";

        print_r($date);

        exit;

    }
}
