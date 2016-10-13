<?php
class AFX_Contact_Options {
    
    function __construct() {
        add_action('init', array($this, 'init'));
        add_action('admin_init', array($this, 'admin_init'));
        add_action('admin_menu', array($this, 'admin_actions'));
        add_filter('plugin_action_links', array($this, 'plugin_settings_link'), 10, 2);            
            
    }
    
    function init() {
        if(! class_exists('AFX_Options_Menu', false)) add_action('admin_menu', array(new AFX_Options_Menu(), 'admin_actions'));
    } 
    
     function admin_init() {
        $this->register_and_build_fields();
    } 
    
    function register_and_build_fields() {  
        register_setting('afx_contact_fields', 'afx_contact_from', array($this, 'validate_settings'));
        register_setting('afx_contact_fields', 'afx_contact_bcc', array($this, 'validate_settings'));
        register_setting('afx_contact_fields', 'afx_contact_admin_to', array($this, 'validate_settings'));
    } 
    
    function validate_settings($input) {
        return $input;
    }

    function admin_actions() {  
       global $_registered_pages;
       $hookname = get_plugin_page_hookname('afx-options', 'options-general.php');
       if (!empty($hookname)) {  
        add_action($hookname, array($this, 'options_ui'));  
       }  
          
       $_registered_pages[$hookname] = true;
    }
    
    function options_ui() {
        include(AFX_CONTACT_DIR.'afx_views/options_ui.php');
    }
    
    function plugin_settings_link($links, $file) {
     
        if ( $file == 'afx-contact/afx-contact.php' ) {
            /* Insert the link at the end*/
            $links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'options-general.php?page=afx-options' ), __( 'Settings', 'plugin_domain' ) );
        }
        return $links;
     
    }
    
    static function getFrom() {
        return get_option('afx_contact_from');
    }
    
    static function getBcc() {
        return get_option('afx_contact_bcc');
    }
    
    static function getAdminEmail() {
        return get_option('afx_contact_admin_to');
    }
    
}
