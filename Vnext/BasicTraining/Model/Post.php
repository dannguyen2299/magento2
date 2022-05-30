<?php
namespace Vnext\BasicTraining\Model;
class Post extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Vnext\BasicTraining\Model\ResourceModel\Post');
    }
}
