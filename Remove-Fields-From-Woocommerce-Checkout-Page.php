<?php
// remove Order Notes from checkout field in Woocommerce
add_filter( ‘woocommerce_checkout_fields’ , ‘alter_woocommerce_checkout_fields’ );
function alter_woocommerce_checkout_fields( $fields ) {
unset($fields[‘billing’][‘billing_first_name’]); // remove the customer’s First Name for billing
unset($fields[‘billing’][‘billing_last_name’]); // remove the customer’s last name for billing
unset($fields[‘billing’][‘billing_company’]); // remove the option to enter in a company
unset($fields[‘billing’][‘billing_address_1’]); // remove the first line of the address
unset($fields[‘billing’][‘billing_address_2’]); // remove the second line of the address
unset($fields[‘billing’][‘billing_city’]); // remove the billing city
unset($fields[‘billing’][‘billing_postcode’]); // remove the ZIP / postal code field
unset($fields[‘billing’][‘billing_country’]); // remove the billing country
unset($fields[‘billing’][‘billing_state’]); // remove the billing state
unset($fields[‘billing’][‘billing_email’]); // remove the billing email address – note that the customer may not get a receipt!
unset($fields[‘billing’][‘billing_phone’]); // remove the option to enter in a billing phone number
unset($fields[‘shipping’][‘shipping_first_name’]);
unset($fields[‘shipping’][‘shipping_last_name’]);
unset($fields[‘shipping’][‘shipping_company’]);
unset($fields[‘shipping’][‘shipping_address_1’]);
unset($fields[‘shipping’][‘shipping_address_2’]);
unset($fields[‘shipping’][‘shipping_city’]);
unset($fields[‘shipping’][‘shipping_postcode’]);
unset($fields[‘shipping’][‘shipping_country’]);
unset($fields[‘shipping’][‘shipping_state’]);
unset($fields[‘account’][‘account_username’]); // removing this or the two fields below would prevent users from creating an account, which you can do via normal WordPress + Woocommerce capabilities anyway
unset($fields[‘account’][‘account_password’]);
unset($fields[‘account’][‘account_password-2’]);
unset($fields[‘order’][‘order_comments’]); // removes the order comments / notes field
return $fields;
}