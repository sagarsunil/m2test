<?php
namespace Cccc\Profile\Block\Adminhtml\Profile\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_profile_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Profile Information'));
    }
}