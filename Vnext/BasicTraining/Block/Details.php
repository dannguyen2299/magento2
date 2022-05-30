<?php
namespace Vnext\BasicTraining\Block;

use Magento\Framework\View\Element\Template\Context;

class Details extends \Magento\Framework\View\Element\Template
{
    /** @var  \Vnext\BasicTraining\Model\PostFactory*/
    protected $post_factory;

    public function __construct(
        Context $context,
        \Vnext\BasicTraining\Model\PostFactory $post_factory
    )
    {
        $this->post_factory = $post_factory;
        parent::__construct($context);
    }
    public function getDetails()
    {
        $student =$this->getRequest()->getParam('ids');
        $result = $this->post_factory->create()->load($student);
        return $result;
    }
}
