<?php

class RevotechApi_WebserviceCrendential_Model_Api_V2 extends RevotechApi_WebserviceCrendential_Model_Api {
    
   
    /**
     * Prepare data to insert/update.
     * Creating array for stdClass Object
     *
     * @param stdClass $data
     * @return array
     */
   
  
      public function my_method_name($shopperId,$oldpassword,$newpassword) {

$customer = Mage::getModel('customer/customer')->load($shopperId);

$email = $customer->getEmail();
$websiteID=$customer->getWebsiteID();


//$email = $customerData->getEmail();
$result = array('customer_id'=> $shopperId, 'success'=> 'zz');
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

// $customerData=  json_decode($customerData);
 //   $customerData = get_object_vars($customerData);
 //$customerData = get_object_vars($customerData);
/* $array=array();
 foreach ($customerData as $key => $object) {
    $array[]= $object->password;
} */
        //return $customerData;
       // implode(",", $customerData);
       // return array(array('customer_id' =>$shopperId,'success' => print_r($password,true)));
     // return $shopperId;
  //  }

 //   public function my_method_name1($shopperId, $customerData) {
        //$customerData = json_decode($customerData);
        

        // print_r($customerData);
        //exit();
        //$customer = Mage::getModel('customer/customer')->load($shopperid);
        //unserialize($customerData);
        //foreach ($customerData as $value) {
        //$arrayz=array();
        //$arrayz=json_decode($customerData);
        // str_replace("\n", 'aa', $arrayz);
        // $array = get_object_vars($dataz);
        /*   $customerData = json_decode(json_encode($customerData),true);
          $customerData = get_object_vars($customerData);
          foreach ($customerData as $key => $value) {
          // echo $value . " is a " . $key . ".<br />";

          $arrayz[$key]=$value;
          } */

        /* foreach ($array as $product) {
          $arrayz[] =  $product;
          } */
        //return $arrayz;
        //$customerData = str_replace(array(""), '\n', $customerData);
       /* if(is_array($customerData)) {
            //$customerData = json_encode(array($customerData));
            $customerData = explode(",", $customerData);
        } else {
            $customerData = "Hello";
        }*/
        
     /*
     $test = array();
        foreach($customerData as $row) {
            $test[] = $row['oldpassword'];
        } 
        return array(array('email' => 'tt', 'newpassword' => print_r($customerData, true), 'website_id' => '1', 'oldpassword' => $shopperId));
     
        */

//  return array(array('email'=>'tt','newpassword'=>  json_decode($customerData),'website_id'=>'1','oldpassword' =>$shopperId));
        //return array(array('oldpassword'=>$oldpassword,'newpassword' =>$shopperId));
        //  foreach( $dataz as $key=>$value){
        //  return array(array('oldpassword'=>$value['oldpassword'],'newpassword' =>$value[1],'email' =>$value));       }
        //}
        /*  try {
          $result = Mage::getModel('customer/customer')->setWebsiteId($customerData->website_id)->authenticate($customerData->email, $customerData->oldpassword);
          $customer->setPassword($customerData->newpassword);
          $customer->save();
          $zz[] = 'Success';
          return $zz;
          } catch (Exception $e) {
          echo 'Caught exception: ', $e->getMessage(), "\n";
          $zz[] = 'Invladi Password1';
          return $zz;
          } */
   // }

}
