<?php
namespace Cccc\Profile\Block\Adminhtml;
class Profile extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_profile';/*block grid.php directory*/
        $this->_blockGroup = 'Cccc_Profile';
        $this->_headerText = __('Profile');
        $this->_addButtonLabel = __('Add New Entry'); 
        parent::_construct();
		
    }
}