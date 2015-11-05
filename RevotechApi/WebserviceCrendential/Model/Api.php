<?php

class RevotechApi_WebserviceCrendential_Model_Api extends Mage_Api_Model_Resource_Abstract {
      
    public function my_method_name($shopperId,$oldpassword,$newpassword) {

$customer = Mage::getModel('customer/customer')->load($shopperId);

$email = $customer->getEmail();
$websiteID=$customer->getWebsiteID();


//$email = $customerData->getEmail();
$result = array('customer_id'=> $shopperId, 'success'=> $email);
  //$result = Mage::getModel('customer/customer')->setWebsiteId($websiteID)->authenticate($email, $oldpassword);
  /* try {
         $resultA = Mage::getModel('customer/customer')->setWebsiteId($websiteID)->authenticate($email,$oldpassword);
         if($resultA==1){
             $customer->setPassword($newpassword);
          $customer->save();
             
         }
         
          $result = array('customer_id'=> $shopperId, 'success'=> 'true' );
        
          } catch (Exception $e) {
          echo 'Caught exception: ', $e->getMessage(), "\n";
          $result = array('customer_id'=> $shopperId, 'success'=> 'fail');
         
          }  */
    //$result = array('customer_id'=> $shopperId, 'success'=> $websiteID);
       return $result;
    }
}
