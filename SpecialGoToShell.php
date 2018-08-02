<?php

use MediaWiki\Shell\Shell;

if ( !defined( 'MEDIAWIKI' ) ) {
   die( 'This file is a MediaWiki extension. It is not a valid entry point' );
}

class SpecialGoToShell extends SpecialPage {
   function __construct( ) {
      parent::__construct( 'GoToShell' );
   }

   function execute( $par ) {
      global $wgGoToShellCommand;
      $user = $this->getUser();
      // Missing handbasket, er, permission
      if ( !$user->isAllowed( 'gotoshell' ) ) {
         // Shell no, this user won't go
         throw new PermissionsError( null, array( array(
            'gotoshell-notallowed' ) ) );
      }
      $this->setHeaders();
      $this->getOutput()->addWikiText ( "<big>'''" . wfMessage( 'gotoshell-command' )
         . "'''</big><br>$wgGoToShellCommand<br><br>"
         . "<big>'''" . wfMessage ( 'gotoshell-result' ) . "'''</big><br>" );
      // To shell with this user!
      // Some shell commands (ex. mediawiki maintenance scripts) might write to both stdout and
      // stderr. Capture and output both, with errors before normal output for greater visibility.
      if ( Shell::isDisabled() ) {
         $this->getOutput()->addWikiText( wfMessage( 'gotoshell-disabled' ) );
      } else {
         $result = Shell::command( [] )
            ->unsafeParams( $wgGoToShellCommand )
            ->restrict( Shell::RESTRICT_NONE )
            ->execute();

         $this->processOutput( $result->getStderr() );
         $this->processOutput( $result->getStdout() );
      }
   }

   /**
    * @param $rawOutput
    * @throws MWException
    */
   protected function processOutput( $rawOutput ) {
      if ( $rawOutput ) {
         foreach ( explode( "\n", $rawOutput ) as $line ) {
            $this->getOutput()->addWikiText( $line );
         }
      }
   }

   protected function getGroupName() {
      return 'other';
   }
}

