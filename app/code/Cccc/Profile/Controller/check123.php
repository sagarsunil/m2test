<?php
/**
 *
 * Copyright © 2015 Cccccommerce. All rights reserved.
 */
namespace Cccc\Profile\Controller;

class Check extends \Magento\Framework\App\Action\Action
{

		protected $cookieMetadataFactory;

		const COOKIE_NAME = 'zipcheck';

    	const COOKIE_PATH = '/';

		const COOKIE_LIFETIME = 600;

		public function __construct(
		     \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
             \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
		  ) 
		{
		    $this->cookieMetadataFactory = $cookieMetadataFactory;
		}


		 public function index()
    	{
    		echo 123;die;
    		$cookieValue = $_POST['zipcode'];
	        $metadata = $this->cookieMetadataFactory->createPublicCookieMetadata()
	            ->setPath(self::COOKIE_PATH)
	            ->setHttpOnly(true);
	        $this->cookieManager->setPublicCookie(self::COOKIE_NAME, $cookieValue, $metadata);
    	}

}
