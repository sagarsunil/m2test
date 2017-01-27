<?php
/**
 *
 * Copyright © 2015 Cccccommerce. All rights reserved.
 */
namespace Cccc\Profile\Controller\Profile;

class Check extends \Magento\Framework\App\Action\Action
{

		protected $cookieMetadataFactory;

		protected $cookieManager;

		const COOKIE_NAME = 'zipcheck';

    	const COOKIE_PATH = '/';

		const COOKIE_LIFETIME = 600;

		public function __construct(
			 \Magento\Framework\App\Action\Context $context,
		     \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
             \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
		  ) 
		{
			parent::__construct($context);
		    $this->cookieMetadataFactory = $cookieMetadataFactory;
		    $this->cookieManager = $cookieManager;
		}


		 public function execute()
    	{
    		//echo '<pre>';print_r($_POST);die;


    		$cookieValue = $_POST['zipcode'];

	        $metadata = $this->cookieMetadataFactory->createPublicCookieMetadata()
	            ->setPath(self::COOKIE_PATH)
	            ->setHttpOnly(true);
	       $this->cookieManager->setPublicCookie(self::COOKIE_NAME, $cookieValue, $metadata);
    	}

}
