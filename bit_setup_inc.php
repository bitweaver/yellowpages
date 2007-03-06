<?php
global $gBitSystem;
$registerHash = array(
	'package_name' => 'yellowpages',
	'package_path' => dirname( __FILE__ ).'/',
	'homeable' => TRUE,
);
$gBitSystem->registerPackage( $registerHash );

if ($gBitSystem->isPackageActive('yellowpages' ) ) {
    $gBitSystem->registerAppMenu('yellowpages', 'YellowPages', YELLOWPAGES_PKG_URL.'index.php', 'bitpackage:yellowpages/menu_yellowpages.tpl', 'yellowpages');
}

?>