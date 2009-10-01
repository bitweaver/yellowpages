<?php
// $Header: /cvsroot/bitweaver/_bit_yellowpages/admin/admin_yellowpages_inc.php,v 1.5 2009/10/01 14:17:07 wjames5 Exp $
// Copyright (c) 2005 bitweaver YellowPages
// All Rights Reserved. See below for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See http://www.gnu.org/copyleft/lesser.html for details.

if (isset($_REQUEST["yellowpagesset"]) && isset($_REQUEST["homeYellowPages"])) {
    $gBitSystem->storePreference("home_yellowpages", $_REQUEST["homeYellowPages"]);
    $gBitSmarty->assign('home_yellowpages', $_REQUEST["homeYellowPages"]);
}

require_once(YELLOWPAGES_PKG_PATH.'YellowPages.php' );

$formYellowPagesLists = array(
	"yellowpages_list_yellowpages_id" => array(
		'label' => 'Id',
		'note' => 'Display the yellowpages id.',
	),
	"yellowpages_list_title" => array(
		'label' => 'Title',
		'note' => 'Display the title.',
	),
	"yellowpages_list_city" => array(
		'label' => 'City',
		'note' => 'Display the region.',
	),
	"yellowpages_list_region" => array(
		'label' => 'State or Province',
		'note' => 'Display the state or province.',
	),
	"yellowpages_list_country" => array(
		'label' => 'Country',
		'note' => 'Display the country.',
	),
);
$gBitSmarty->assign( 'formYellowPagesLists',$formYellowPagesLists );

$processForm = set_tab();

if( $processForm ) {
	$yellowpagesToggles = array_merge( $formYellowPagesLists );
	foreach( $yellowpagesToggles as $item => $data ) {
		simple_set_toggle( $item );
	}

}

$yellowpage = new YellowPages();
$yellowpages = $yellowpage->getList( $_REQUEST );
$gBitSmarty->assign_by_ref('yellowpages', $yellowpages['data']);
?>
