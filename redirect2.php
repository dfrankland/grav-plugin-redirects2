<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page\Page;

class Redirect2Plugin extends Plugin {

    public static function getSubscribedEvents () {
        return [ 'onPluginsInitialized' => [ 'onPluginsInitialized', 0 ] ];
    }

    public function onPluginsInitialized () {
      if ( $this->isAdmin() ) {
        $this->active = false;
        return;
      }
      $this->enable( [ 'onPageInitialized' => [ 'onPageInitialized', 0 ] ] );
    }

    public function onPageInitialized () {
      $grav = $this->grav;
      $debugger = $grav[ 'debugger' ];
      $header = $grav[ 'page' ]->header();
      if ( isset( $header->redirect2 ) ) {
        if ( isset( $header->redirect2[ 'status' ] ) ) {
          $status = $header->redirect2[ 'status' ];
          $debugger->addMessage( $status );
          if( is_numeric( $status ) ){
            switch ( $status ) {
              case '201':
              case '300':
              case '301':
              case '302':
              case '303':
              case '304':
              case '305':
                http_response_code( $status );
                break;
              default:
                $debugger->addMessage( 'Redirect2 status is not one of 201, 300, 301, 302, 303, 304, or 305.' );
                break;
            }
          }else{
            $debugger->addMessage( 'Redirect2 status is not a number.' );
          }
        }
        if ( isset( $header->redirect2[ 'url' ] ) ) {
          header( 'Location: ' . $header->redirect2[ 'url' ] );
          exit;
        }else{
          $debugger->addMessage( 'Redirect2 url not found.' );
        }
      }
    }
}
