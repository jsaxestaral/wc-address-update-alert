<?php 
/**
 * Custom Email
 *
 * An email sent to the admin when an address is updated
 * 
 * @class       Address_Update_Email
 * @extends     WC_Email
 *
 */
class Address_Update_Email extends WC_Email {
    
    function __construct() {
        
        // Add email ID, title, description, heading, subject
        // set ID, this simply needs to be a unique name
		$this->id = 'wc_customer_address_update';

		// this is the title in WooCommerce Email settings
		$this->title = 'Customer Address Change';

		// this is the description in WooCommerce email settings
		$this->description = 'Customer Address Change emails are sent when a customer saves their address';
        
		// these are the default heading and subject lines that can be overridden using the settings
		$this->heading = 'Customer Address Change';
		$this->subject = 'Customer Address Change';

		// email template path
        $this->template_html    = 'emails/address-update-email.php';
        $this->template_plain   = 'emails/plain/address-update-email.php';

        // Triggers for this email
        add_action( 'customer_address_change_email_notification', array( $this, 'trigger' ), 10, 2 );
        
        // Call parent constructor
        parent::__construct();
        
        // Other settings
        $this->template_base = CUSTOM_TEMPLATE_PATH;
        // default the email recipient to the admin's email address
        $this->recipient = $this->get_option( 'recipient', get_option( 'admin_email' ) );
    }
    
    // This function collects the data and sends the email
    function trigger( $customer_id, $load_address ) {

        $this->object = get_user_by('ID', $customer_id );
        
        // if no recipient is set, do not send the email
        if ( ! $this->get_recipient() ) {
            return;
        }
        // send the email
        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        
    }
    
    /**
	 * Get content html.
	 *
	 * @return string
	 */
	function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'user'   => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this
		), '', $this->template_base );
	}

	/**
	 * Get content plain.
	 *
	 * @return string
	 */
	function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'user'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this
		), '', $this->template_base );
	}
    
    // form fields that are displayed in WooCommerce->Settings->Emails
    function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title' 		=> __( 'Enable/Disable', 'custom-email' ),
                'type' 			=> 'checkbox',
                'label' 		=> __( 'Enable this email notification', 'custom-email' ),
                'default' 		=> 'yes'
            ),
            'recipient' => array(
                'title'         => __( 'Recipient', 'custom-email' ),
                'type'          => 'text',
                'description'   => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to %s', 'custom-email' ), get_option( 'admin_email' ) ),
                'default'       => get_option( 'admin_email' )
            ),
            'subject' => array(
                'title' 		=> __( 'Subject', 'custom-email' ),
                'type' 			=> 'text',
                'description' 	=> sprintf( __( 'This controls the email subject line. Leave blank to use the default subject: <code>%s</code>.', 'custom-email' ), $this->subject ),
                'placeholder' 	=> '',
                'default' 		=> ''
            ),
            'heading' => array(
                'title' 		=> __( 'Email Heading', 'custom-email' ),
                'type' 			=> 'text',
                'description' 	=> sprintf( __( 'This controls the main heading contained within the email notification. Leave blank to use the default heading: <code>%s</code>.', 'custom-email' ), $this->heading ),
                'placeholder' 	=> '',
                'default' 		=> ''
            ),
            'email_type' => array(
                'title' 		=> __( 'Email type', 'custom-email' ),
                'type' 			=> 'select',
                'description' 	=> __( 'Choose which format of email to send.', 'custom-email' ),
                'default' 		=> 'html',
                'class'			=> 'email_type',
                'options'		=> array(
                    'plain'		 	=> __( 'Plain text', 'custom-email' ),
                    'html' 			=> __( 'HTML', 'custom-email' ),
                    'multipart' 	=> __( 'Multipart', 'custom-email' ),
                )
            )
        );
    }
    
}
return new Address_Update_Email();
?>