<?php
global $afx_contact_db_version;
$afx_contact_db_version = "0.7";

function afx_contact_install() {
    global $wpdb;
    global $afx_contact_db_version;
    $contact_table = $wpdb->prefix."afx_contact";
    
    AFX_DEBUG::_log("Creating/Updating contact database");
    
    $sql = "CREATE TABLE `{$contact_table}` (
      `contact_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `email_from` varchar(255) DEFAULT NULL,
      `email_to` varchar(500) DEFAULT NULL,
      `email_bcc` varchar(500) DEFAULT NULL,
      `subject` varchar(500) DEFAULT NULL,
      `content` text,
      `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      `response` varchar(500) DEFAULT NULL,
      UNIQUE KEY (`contact_id`)
    )
        
    ";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    
    if(get_option("afx_contact_db_version")!==false) update_option( "afx_contact_db_version", $afx_contact_db_version );
    else add_option( "afx_contact_db_version", $afx_contact_db_version );  
}

register_activation_hook( AFX_CONTACT_DIR."afx-contact.php", 'afx_contact_install' );

$current_db_version = get_option("afx_contact_db_version");

if($current_db_version==false || $current_db_version < $afx_contact_db_version) {
    afx_contact_install();
}