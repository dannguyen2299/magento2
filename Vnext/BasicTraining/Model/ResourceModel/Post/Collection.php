<?php
namespace Vnext\BasicTraining\Model\ResourceModel\Post;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';

    protected function _construct()
    {
        $this->_init('Vnext\BasicTraining\Model\Post', 'Vnext\BasicTraining\Model\ResourceModel\Post');
    }
}
