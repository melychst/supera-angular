<?php
/*
Plugin Name: AFX Contact
Plugin URI: http://www.afxdesign.com/
Description: Lightweight website contact management plugin for developers
Version: 0.1
Author: AFX Design
Author URI: http://www.afxdesign.com/
License: Copyright 2013  AFX Design Ltd  (email : anthony@afxdesign.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( 'AFX_CONTACT_DIR', plugin_dir_path( __FILE__ ) );
define( 'AFX_CONTACT_URL', plugin_dir_url( __FILE__ ) );

function afx_contact_autoload($class) {
    $classfile1 = AFX_CONTACT_DIR.'/afx_scripts/'.strtolower($class).'.php';
    $classfile2 = AFX_CONTACT_DIR.'/afx_models/'.strtolower($class).'.php';
    if(file_exists($classfile1)) include_once $classfile1;
    else if(file_exists($classfile2)) include_once $classfile2;
}
spl_autoload_register('afx_contact_autoload');


/****** Install, activation & deactivation******/
include_once( AFX_CONTACT_DIR . 'afx_scripts/install.php' );

/****** Options to get post type and continue******/
$op = new AFX_Contact_Options();
$ui = new AFX_Contact_Ui();

function afx_mail($args) {
    $c = new AFX_Contact();
    return $c->mail($args);
}

