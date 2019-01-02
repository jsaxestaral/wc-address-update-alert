<?php
/**
* Plugin Name: WC Customer Address Update Alert
* Plugin URI: https://www.jacksaxestaral.com/
* Description: This is a plugin to send a custom WC email when a user updates their address.
* Version: 1.0
* Author: Jack S
* Author URI: http://jacksaxestaral.com/
**/

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

include dirname( __FILE__ ) . '/class-custom-email-manager.php';