<?php
if (class_exists( "AFX_Debug" ) ) return;

class AFX_Debug {
    public static function _log($message) {
        if( WP_DEBUG === true ){
          if( is_array( $message ) || is_object( $message ) ){
            error_log( print_r( $message, true ) );
          } else {
            error_log( $message );
          }
        }
    }
}