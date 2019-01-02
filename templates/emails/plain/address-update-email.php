<?php
/**
 * Admin new order email
 */

$user_id = $user->ID;
$user_info = get_userdata($user_id);
$username = $user_info->user_login;


echo "= " . $email_heading . " =\n\n";
echo $user->first_name." ".$user->last_name." has updated their address information.  Please update their subscription shipping address to match the information provided below.\n\n";
echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo "Shipping Address:\n";
echo get_user_meta( $user_id, 'shipping_first_name', true ). " ". get_user_meta( $user_id, 'shipping_last_name', true ) . "\n";
if(get_user_meta( $user_id, 'shipping_company', true )) {
	echo get_user_meta( $user_id, 'shipping_company', true ). "\n";
}
echo get_user_meta( $user_id, 'shipping_address_1', true ) . "\n";
echo get_user_meta( $user_id, 'shipping_address_2', true ) . "\n";
echo get_user_meta( $user_id, 'shipping_city', true ) . ", ". get_user_meta( $user_id, 'shipping_state', true )." ". get_user_meta( $user_id, 'shipping_postcode', true )  . "\n";
echo get_user_meta( $user_id, 'shipping_country', true ). "\n";

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo "Billing Address:</strong>\n";
echo get_user_meta( $user_id, 'billing_first_name', true ). " ". get_user_meta( $user_id, 'billing_last_name', true ) . "\n";
if(get_user_meta( $user_id, 'billing_company', true )) {
	echo get_user_meta( $user_id, 'billiong_company', true ). "\n";
}
echo get_user_meta( $user_id, 'billing_address_1', true ) . "\n";
echo get_user_meta( $user_id, 'billing_address_2', true ) . "\n";
echo get_user_meta( $user_id, 'billing_city', true ) . ", ". get_user_meta( $user_id, 'billing_state', true )." ". get_user_meta( $user_id, 'billing_postcode', true )  . "\n";
echo get_user_meta( $user_id, 'billing_country', true ). "\n";

echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo "Other Information:\n";
echo "Phone: " . get_user_meta( $user_id, 'billing_phone', true ) . "\n";
echo "Email: " . get_user_meta( $user_id, 'billing_email', true ) . "\n";



echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );