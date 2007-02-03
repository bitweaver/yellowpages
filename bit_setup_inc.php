<?php
global $gBitSystem;
$gBitSystem->registerPackage('yellowpages', dirname(__FILE__).'/' );

if ($gBitSystem->isPackageActive('yellowpages' ) ) {
    $gBitSystem->registerAppMenu('yellowpages', 'YellowPages', YELLOWPAGES_PKG_URL.'index.php', 'bitpackage:yellowpages/menu_yellowpages.tpl', 'yellowpages');
}

?>
