<?php
global $gBitSystem;
$registerHash = array(
	'package_name' => 'yellowpages',
	'package_path' => dirname( __FILE__ ).'/',
);
$gBitSystem->registerPackage( $registerHash );

if ($gBitSystem->isPackageActive('yellowpages' ) ) {
	$menuHash = array(
		'package_name'  => YELLOWPAGES_PKG_NAME,
		'index_url'     => YELLOWPAGES_PKG_URL.'index.php',
		'menu_template' => 'bitpackage:yellowpages/menu_yellowpages.tpl',
	);
	$gBitSystem->registerAppMenu( $menuHash );
}

?>
