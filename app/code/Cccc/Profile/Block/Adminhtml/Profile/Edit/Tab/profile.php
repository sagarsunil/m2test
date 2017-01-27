<?php
namespace Cccc\Profile\Block\Adminhtml\Profile\Edit\Tab;

use Cccc\Profile\Model\Status;

class profile extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
		/* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('profile_profile');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('profile')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

		$fieldset->addField(
            'name',
            'text',
            array(
                'name' => 'name',
                'label' => __('name'),
                'title' => __('name'),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'image',
            'image',
            array(
                'name' => 'image',
                'label' => __('image'),
                'title' => __('image'),
                //'renderer' => 'Cccc\Profile\Block\Adminhtml\Profile\Helper\Renderer\Image',
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'status',
            'select',
            array(
                'name' => 'status',
                'label' => __('status'),
                'title' => __('status'),
                'values' => [
                    [
                        'value' => Status::STATUS_ENABLED,
                        'label' => __('Yes'),
                    ],
                    [
                        'value' => Status::STATUS_DISABLED,
                        'label' => __('No'),
                    ],
                ],
                /*'required' => true,*/
            )
        );

		$fieldset->addField(
            'sort_order',
            'text',
            array(
                'name' => 'sort_order',
                'label' => __('sort order'),
                'title' => __('sort order'),
                /*'required' => true,*/
            )
        );
		
		
		/*{{CedAddFormField}}*/
        
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('profile');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('profile');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
