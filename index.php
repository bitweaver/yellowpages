<?php
// $Header: /cvsroot/bitweaver/_bit_yellowpages/index.php,v 1.5 2009/10/01 13:45:55 wjames5 Exp $
// Copyright (c) 2004 bitweaver YellowPages
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See http://www.gnu.org/copyleft/lesser.html for details.

// Initialization
require_once('../bit_setup_inc.php' );

// Is package installed and enabled
$gBitSystem->verifyPackage('yellowpages' );

// Now check permissions to access this page
$gBitSystem->verifyPermission('p_read_yellowpages' );

if (!isset($_REQUEST['yellowpages_id'] ) ) {
    $_REQUEST['yellowpages_id'] = $gBitSystem->getConfig( "home_yellowpages" );
}
require_once(YELLOWPAGES_PKG_PATH.'lookup_yellowpages_inc.php' );

// Display the template
$gBitSystem->display( 'bitpackage:yellowpages/show_yellowpages.tpl', tra( 'YellowPages' ), array( 'display_mode' => 'display' ));
?>
