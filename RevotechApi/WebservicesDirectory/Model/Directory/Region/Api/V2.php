<?php
class RevotechApi_WebservicesDirectory_Model_Directory_Region_Api_V2 extends Mage_Directory_Model_Region_Api_V2

{
     public function items($email,$storeId) { 
  //$customer = Mage::getModel('customer/customer')->load(6); 
/*if ($customer->getId()) {
    try {
       $newResetPasswordLinkToken =  Mage::helper('customer')->generateResetPasswordLinkToken();
     $customer->changeResetPasswordLinkToken($newResetPasswordLinkToken);
       $customer->sendPasswordResetConfirmationEmail();
        $textMsg= "CHECK YOUR EMAIL";
    } catch (Exception $exception) {
         $textMsg= "FAILED";
       
    }
} */
  
   $customer = Mage::getModel('customer/customer')->setWebsiteId(Mage::app()->getStore($storeId)->getWebsiteId())->loadByEmail($email);
  //  $customer = Mage::getModel('customer/customer')->setWebsiteId(1)->loadByEmail($email);
     //   $website_id =Mage::app()->getStore()->getId(); 
     //  $customer = Mage::getModel('customer/customer')->setWebsiteId(1)->loadByEmail($email);
     //  $customer = Mage::getModel("customer/customer"); 
     //  $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
      //  $customer->loadByEmail($email);
      //  $idz= $customer->getId();
   
   //  $customer->loadByEmail($email); 
  //    $customer = Mage::getModel("customer/customer");
    //  $customer->setWebsiteId(Mage::app()->getWebsite()->getId()); 
     
     
    // $z=$customer->getId(); 
    
      
   $customerId=0;
      if ($customer->getId()) {            
		try {  
                    $customerId=$customer->getId();
		$newResetPasswordLinkToken =  Mage::helper('customer')->generateResetPasswordLinkToken();
                $customer->changeResetPasswordLinkToken($newResetPasswordLinkToken);
                $customer->sendPasswordResetConfirmationEmail();
                   $textMsg= "CHECK YOUR EMAIL";
            } 
			catch (Exception $exception) {  
			Mage::log($exception);
                         $textMsg= "FAILED";
            }       
			}  
                        else
                        {
                              $textMsg= "Invalid Email";
                              $customerId='Invalid Customer';
                        }

         $result[] = array('region_id'=>$customerId,'code'=>$textMsg,'name'=>$email);
          return $result;

    }

}