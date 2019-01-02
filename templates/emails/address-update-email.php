<?php
/**
 * Admin new order email
 */

$user_id = $user->ID;
$user_info = get_userdata($user_id);
$username = $user_info->user_login;

$file = 'people.txt';
	   // The new person to add to the file
	   $person = "MIMICING SENDING AN EMAIL.\n";
	   // Write the contents to the file, 
	   // using the FILE_APPEND flag to append the content to the end of the file
	   // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
	   file_put_contents($file, $person, FILE_APPEND | LOCK_EX);

$body = '<p><strong>'.$user->first_name.' '.$user->last_name.'</strong> has updated their address information.  Please update their subscription shipping address to match the information provided below.</p>';
$body .= '<table cellspacing="0" cellpadding="6" style="width: 100%; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;" border="1">';
$body .= '<tr><td class="td" colspan="2"><strong>Account</strong></td></tr>';
$body .= '<tr><td class="td">Name: </td><td class="td">' . $user->first_name.' '.$user->last_name . '</td></tr>';
$body .= '<tr><td class="td">Username: </td><td class="td">' . $user->user_login . '</td></tr>';
$body .= '<tr><td class="td" colspan="2">&nbsp;</td></tr>';
$body .= '<tr><td class="td" colspan="2"><strong>Shipping Address</strong></td></tr>';
$body .= '<tr><td class="td">Name: </td><td class="td">' . get_user_meta( $user_id, 'shipping_first_name', true ). ' '. get_user_meta( $user_id, 'shipping_last_name', true ) . '</td></tr>';
$body .= '<tr><td class="td">Company: </td><td class="td">' . get_user_meta( $user_id, 'shipping_company', true )     . '</td></tr>';
$body .= '<tr><td class="td">Address 1: </td><td class="td">' . get_user_meta( $user_id, 'shipping_address_1', true ) . '</td></tr>';
$body .= '<tr><td class="td">Address 2: </td><td class="td">' . get_user_meta( $user_id, 'shipping_address_2', true ) . '</td></tr>';
$body .= '<tr><td class="td">City: </td><td class="td">' . get_user_meta( $user_id, 'shipping_city', true )           . '</td></tr>';
$body .= '<tr><td class="td">Post code: </td><td class="td">' . get_user_meta( $user_id, 'shipping_postcode', true )  . '</td></tr>';
$body .= '<tr><td class="td">Country: </td><td class="td">' . get_user_meta( $user_id, 'shipping_country', true )     . '</td></tr>';
$body .= '<tr><td class="td">State: </td><td class="td">' . get_user_meta( $user_id, 'shipping_state', true )         . '</td></tr>';
$body .= '<tr><td class="td" colspan="2">&nbsp;</td></tr>';
$body .= '<tr><td class="td" colspan="2"><strong>Billing Address</strong></td></tr>';
$body .= '<tr><td class="td">Name: </td><td class="td">' . get_user_meta( $user_id, 'billing_first_name', true ). ' '. get_user_meta( $user_id, 'billing_last_name', true ) . '</td></tr>';
$body .= '<tr><td class="td">Company: </td><td class="td">' . get_user_meta( $user_id, 'billing_company', true )      . '</td></tr>';
$body .= '<tr><td class="td">Address 1: </td><td class="td">' . get_user_meta( $user_id, 'billing_address_1', true )  . '</td></tr>';
$body .= '<tr><td class="td">Address 2: </td><td class="td">' . get_user_meta( $user_id, 'billing_address_2', true )  . '</td></tr>';
$body .= '<tr><td class="td">City: </td><td class="td">' . get_user_meta( $user_id, 'billing_city', true )            . '</td></tr>';
$body .= '<tr><td class="td">Post code: </td><td class="td">' . get_user_meta( $user_id, 'billing_postcode', true )   . '</td></tr>';
$body .= '<tr><td class="td">Country: </td><td class="td">' . get_user_meta( $user_id, 'billing_country', true )      . '</td></tr>';
$body .= '<tr><td class="td">State: </td><td class="td">' . get_user_meta( $user_id, 'billing_state', true )          . '</td></tr>';
$body .= '<tr><td class="td">Phone: </td><td class="td">' . get_user_meta( $user_id, 'billing_phone', true )          . '</td></tr>';
$body .= '<tr><td class="td">Email: </td><td class="td">' . get_user_meta( $user_id, 'billing_email', true )          . '</td></tr>';
$body .= '</table>';
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<?php echo $body; ?>
<?php do_action( 'woocommerce_email_footer' ); ?>