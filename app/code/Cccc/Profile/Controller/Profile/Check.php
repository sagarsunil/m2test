<?php
/**
 *
 * Copyright © 2015 Cccccommerce. All rights reserved.
 */
namespace Cccc\Profile\Controller\Profile;

class Check extends \Magento\Framework\App\Action\Action
{

		protected $cookieMetadataFactory;

		protected $_customer;

		protected $_customerSession;

		protected $cookieManager;

		const COOKIE_NAME = 'zipcheck';

    	const COOKIE_PATH = '/';

		const COOKIE_LIFETIME = 600;

		 protected $_responseFactory;

		  protected $_storeManager;
         
         protected $_url;


		public function __construct(
			 \Magento\Framework\App\Action\Context $context,
		     \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
             \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
             \Magento\Customer\Model\Customer $customer,
              \Magento\Store\Model\StoreManagerInterface $storeManager,
             \Magento\Customer\Model\Session $customerSession,
             \Magento\Framework\Controller\Result\Redirect $resultRedirect,
             \Magento\Framework\App\ResponseFactory $responseFactory,
             \Magento\Framework\UrlInterface $url,
             \Magento\Framework\Controller\Result\Json $result
		  ) 
		{
			parent::__construct($context);
		    $this->cookieMetadataFactory = $cookieMetadataFactory;
		    $this->cookieManager = $cookieManager;
		     $this->resultRedirectFactory = $resultRedirect;
		     $this->_storeManager = $storeManager;
		    $this->_customer = $customer;
    		$this->_customerSession = $customerSession;
    		 $this->_responseFactory = $responseFactory;
            $this->_url = $url;
            $this->resultJsonFactory = $result;
		}

	



		 public function execute()
    	{
    		//echo '<pre>';print_r($_POST);die;

    		//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            //$customer = $objectManager->create('Magento\Customer\Model\Customer');

            //echo '<pre>';print_r($_POST);die;

        	
        		$customerNew = $this->_customer;
	            $customerNew->setFirstname($_POST['first_name']);
	            $customerNew->setLastname($_POST['last_name']);
	            $customerNew->setEmail($_POST['email']);
	            $customerNew->setFacebookId($_POST['id']);
	            $customerNew->save();

	            $this->_customerSession->setCustomerAsLoggedIn($customerNew);

	            $result['success'] = 'success';

	            $result['url']  = $this->_storeManager->getStore()->getUrl('customer/account/');

	            echo json_encode($result);

	            //$resultRedirect = $this->resultRedirectFactory->create();
		        //$resultRedirect->setPath('customer/account');
		        //return $resultRedirect;

	            //$RedirectUrl= $this->_url->getUrl('customer/account');
	            //$message= 'success';
	            //$this->_responseFactory->create()->setRedirect($RedirectUrl)->sendResponse($result);

	            //$result1 = $this->resultJsonFactory->create();
			    //$result1->setData(['success' => $message]);
			    //return $result1;     
	          
        	

        	
	
    	}

}
