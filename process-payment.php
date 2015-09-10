<?php 
require_once('../../../oc-load.php');
require_once('functions.php');
     
  if(isset($_POST['payment-button'])){
       $credit_card_number = Params::getParam('credit-card-number');
       $credit_card_type ="visa";
       $expiry_month = Params::getParam('expiry-month');
       $expiry_year = Params::getParam('expiry-year');
       $cvv = Params::getParam('cvv');
       $id = Params::getParam('itemId');
       $user_fullname = Params::getParam('user-fullname');
       $currency = osc_get_preference('default_currency', 'classified');
       $paypal_username = osc_get_preference('paypal_client_id', 'classified');
       $paypal_password = osc_get_preference('paypal_secret', 'classified');
       $paypal_server = osc_get_preference('paypal_server_rest', 'classified');
       $premium_cost = osc_get_preference('premium_cost', 'classified');
       $credentials = array('username' => $paypal_username,
                            'password' => $paypal_password);
       $item = Item::newInstance()->findByPrimaryKey($id);
       
       if ($item['b_premium']==1) {
          osc_add_flash_error_message( _m('Seems like this item is premium already'));
          osc_redirect_to(osc_base_url()); 
          exit;
       }
       
       $result=execute_paypal_auth($paypal_server."oauth2/token", 'grant_type=client_credentials',$credentials);
       $result_array = json_decode($result);
       
       if(isset($result_array->access_token)){
          $json = array('intent' => 'sale',
                        'payer' => array('payment_method' => 'credit_card',
                                         'funding_instruments' => array(array('credit_card' => array('number' => $credit_card_number,
                                                                                                'type'  => $credit_card_type,
                                                                                                'expire_month' => $expiry_month,
                                                                                                'expire_year' => $expiry_year,
                                                                                                'cvv2' => $cvv,
                                                                                                'first_name' => $user_fullname,
                                                                                                'last_name' => $user_fullname
                                                                                                )
                                                                        ))

                                        ),
                        'transactions' => array(array('amount' => array('total' => $premium_cost,
                                                                  'currency' => $currency 
                                                                  ),
                                                'description' => 'Description of payment'                   
                                                ))
            );
            $json=json_encode($json);
            $result = execute_paypal_post($paypal_server."payments/payment", $json,$result_array->access_token);
            $result_array = json_decode($result);
            if(isset($result_array->state)){
              if($result_array->state=="approved"){
                //Mark this item as premium
                $mItems  = new ItemActions( true );
                if ($mItems->premium($id, 1) ) {
                      osc_add_flash_ok_message( _m('Changes have been applied'));
                       osc_redirect_to(osc_route_url('payment-thankyou', array('paymentId' => $result_array->id))); 
                } else {
                      osc_add_flash_error_message( _m('Seems like item is premium already'));
                       osc_redirect_to(osc_route_url('payment-publish', array('itemId' => $id))); 
                }
                //Redirect to thank you page
              }else{
                osc_add_flash_ok_message( _m('Changes have been applied'));
                 osc_redirect_to(osc_route_url('payment-publish', array('itemId' => $id))); 
              
              }
            }elseif(isset($result_array->name)){
              osc_add_flash_ok_message( _m($result_array->name));
               osc_redirect_to(osc_route_url('payment-publish', array('itemId' => $id))); 

            }
       }
  }       
if(isset($_POST['paypal-payment'])){
  $item_title = Params::getParam('item_title');
  $premium_cost = Params::getParam('premium_cost');
  $paypal_api_server = osc_get_preference('paypal_server_classic', 'classified');
  $paypal_server = osc_get_preference('paypal_server', 'classified');
  $username = osc_get_preference('paypal_username', 'classified');
  $password = osc_get_preference('paypal_password', 'classified');
  $signature = osc_get_preference('paypal_signature', 'classified');
  $currency = osc_get_preference('default_currency', 'classified');
  $id = Params::getParam('itemId');
  $post_data = array(
              'USER' => $username,
              'PWD' => $password,
              'SIGNATURE' => $signature,
              'VERSION' => '93',
              'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
              'PAYMENTREQUEST_0_AMT' => $premium_cost,
              'PAYMENTREQUEST_0_ITEMAMT' => $premium_cost,
              'PAYMENTREQUEST_0_CURRENCYCODE' => $currency,
              'PAYMENTREQUEST_0_DESC' => 'Premium payment for '.$item_title,
              'METHOD' => 'SetExpressCheckout',
              'RETURNURL' => osc_route_url('payment-return', array('itemId' => $id)),
              'CANCELURL' => osc_route_url('payment-cancel', array('itemId' => $id)),
              'L_PAYMENTREQUEST_0_AMT0' => $premium_cost,
              'L_PAYMENTREQUEST_0_QTY0' => 1,
              'L_PAYMENTREQUEST_0_NAME0' => 'Premium payment for '.$item_title
              );
  $response=execute_paypal_nvp_post($post_data,$paypal_api_server);
  if($response['ACK']=='Success'){
    $token=$response['TOKEN'];
    header('Location:'. $paypal_server .'cgi-bin/webscr?cmd=_express-checkout&token='.$token);

  }elseif($response['ACK']=='Failure'){
     osc_add_flash_error_message( _m($response['L_LONGMESSAGE0']));
    osc_redirect_to(osc_route_url('payment-publish', array('itemId' => $id))); 
  }
}
?>