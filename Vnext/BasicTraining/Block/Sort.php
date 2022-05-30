<?php
namespace Vnext\BasicTraining\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Block\ArgumentInterface;
//use Magento\Framework\Url\Helper\Data as UrlHelper;
class Sort extends \Magento\Framework\View\Element\Template
{
    /** @var  \Vnext\BasicTraining\Model\PostFactory*/
    protected $post_factory;
    protected  $urlHelper;
    public function __construct(
//        UrlHelper $urlHelper,
        Context $context,
        \Vnext\BasicTraining\Model\PostFactory $post_factory
    )
    {
//        $this->urlHelper = $urlHelper;
        $this->post_factory = $post_factory;
        parent::__construct($context);
    }
    public function getDetails()
    {
        $student =$this->getRequest()->getParam('sort');
            if($student==1) {
                $result = $this->post_factory->create()->getCollection()->setOrder('entity_id', 'DESC');
                return $result;
            }else if($student==2){
                $result = $this->post_factory->create()->getCollection()->setOrder('name', 'DESC');
                return $result;
            }else if($student==3){
                $result = $this->post_factory->create()->getCollection()->setOrder('Dob', 'DESC');
                return $result;
            }




    }
}
