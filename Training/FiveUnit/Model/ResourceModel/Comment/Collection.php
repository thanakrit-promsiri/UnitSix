<?php
namespace Training\FiveUnit\Model\ResourceModel\Comment;

/**
 * Class Collection
 * @package Training\FiveUnit\Model\ResourceModel\Comment
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Training\FiveUnit\Model\Comment', 'Training\FiveUnit\Model\ResourceModel\Comment');
    }
}
