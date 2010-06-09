<?php
// $Header$
// Copyright (c) 2004 bitweaver YellowPages
// All Rights Reserved. See below for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See http://www.gnu.org/copyleft/lesser.html for details.

// Initialization
require_once('../kernel/setup_inc.php' );

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
