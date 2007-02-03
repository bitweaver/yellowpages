<?php
// $Header: /cvsroot/bitweaver/_bit_yellowpages/admin/admin_yellowpages_inc.php,v 1.1 2007/02/03 19:56:56 spiderr Exp $
// Copyright (c) 2005 bitweaver YellowPages
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

if (isset($_REQUEST["yellowpagesset"]) && isset($_REQUEST["homeYellowPages"])) {
    $gBitSystem->storePreference("home_yellowpages", $_REQUEST["homeYellowPages"]);
    $gBitSmarty->assign('home_yellowpages', $_REQUEST["homeYellowPages"]);
}

require_once(YELLOWPAGES_PKG_PATH.'BitYellowPages.php' );

$formYellowPagesLists = array(
	"yellowpages_list_yellowpages_id" => array(
		'label' => 'Id',
		'note' => 'Display the yellowpages id.',
	),
	"yellowpages_list_title" => array(
		'label' => 'Title',
		'note' => 'Display the title.',
	),
	"yellowpages_list_description" => array(
		'label' => 'Description',
		'note' => 'Display the description.',
	),
	"yellowpages_list_data" => array(
		'label' => 'Text',
		'note' => 'Display the text.',
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

$yellowpages = new BitYellowPages();
$yellowpagess = $yellowpages->getList( $_REQUEST );
$gBitSmarty->assign_by_ref('yellowpagess', $yellowpagess['data']);
?>
