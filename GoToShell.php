<?php
/**
 * GoToShell MediaWiki extension.
 *
 * Written by Leucosticte
 * https://www.mediawiki.org/wiki/User:Leucosticte
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Extensions
 */
 
if( !defined( 'MEDIAWIKI' ) ) {
        echo( "This file is an extension to the MediaWiki software and cannot be used standalone.\n" );
        die( 1 );
}
 
$wgExtensionCredits['specialpage'][] = array(
        'path' => __FILE__,
        'name' => 'GoToShell',
        'author' => 'Nathan Larson',
        'url' => 'https://mediawiki.org/wiki/Extension:GoToShell',
        'descriptionmsg' => 'gotoshell-desc',
        'version' => '1.0.1'
);
 
$wgGoToShellCommand = 'ls';
$wgExtensionMessagesFiles['GoToShell'] = __DIR__ . '/GoToShell.i18n.php';
$wgMessagesDirs['GoToShell'] = __DIR__ . '/i18n';
$wgAutoloadClasses['SpecialGoToShell'] = __DIR__ . '/SpecialGoToShell.php';
$wgSpecialPages['GoToShell'] = 'SpecialGoToShell';
// All these bureaucrats can go to shell for all we care
$wgGroupPermissions['bureaucrat']['gotoshell'] = true;

