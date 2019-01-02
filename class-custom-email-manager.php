<?php
/**
 * Handles email sending
 */
class Custom_Email_Manager {

	/**
	 * Constructor sets up actions
	 */
	public function __construct() {
	    
	    // template path
	    define( 'CUSTOM_TEMPLATE_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/templates/' );
	    // hook for when order status is changed
	    add_action( 'woocommerce_customer_save_address', array( $this, 'customer_save_address_email_action' ), 10, 2 );
	    // include the email class files
	    add_filter( 'woocommerce_email_classes', array( $this, 'custom_init_emails' ) );
		
	    add_filter( 'woocommerce_template_directory', array( $this, 'custom_template_directory' ), 10, 2 );
		
	}
	
	public function custom_init_emails( $emails ) {
	    // Include the email class file if it's not included already
	    if ( ! isset( $emails[ 'Address_Update_Email' ] ) ) {
	        $emails[ 'Address_Update_Email' ] = include_once( 'class-address-update-email.php' );
	    }
	
	    return $emails;
	}
	
	public function customer_save_address_email_action( $customer_id, $load_address ) {
	     // add an action for our email trigger if the order id is valid
		 $file = 'cw-output-test.txt';
		 $time = date('m/d/Y h:i:s a', time());
		 $content = $time.": customer_save_address_email_action firing from class-custom-email-manager  ".$customer_id."\n";
		 file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		
		
		 if ( isset( $customer_id ) && 0 != $customer_id ) {
	        new WC_Emails();
    		do_action( 'customer_address_change_email_notification', $customer_id, $load_address );
	    
	    }
	}
	
	public function custom_template_directory( $directory, $template ) {
	   	// ensure the directory name is correct
		if ( false !== strpos( $template, 'address-update' ) ) { //Will pass if address-update is in the template path
			return 'address-update-email';
		}
	
	    return $directory;
	}
	
}// end of class
new Custom_Email_Manager();
?>