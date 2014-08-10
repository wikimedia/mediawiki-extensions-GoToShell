<?php
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
      $viewOutput = $this->getOutput();
      $viewOutput->addWikiText ( "<big>'''" . wfMessage( 'gotoshell-command' )
         . "'''</big><br>$wgGoToShellCommand<br><br>"
         . "<big>'''" . wfMessage ( 'gotoshell-result' ) . "'''</big><br>" );
      // To shell with this user!
      exec ( $wgGoToShellCommand, $outputs );
      foreach ( $outputs as $output ) {
         $viewOutput->addWikiText( $output  );
      }
   }
}

