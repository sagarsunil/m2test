<?php
/**
 * Copyright © 2015 Cccc. All rights reserved.
 */
namespace Cccc\Profile\Model\ResourceModel;

/**
 * Profile resource
 */
class Profile extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('profile_profile', 'id');
    }

  
}
