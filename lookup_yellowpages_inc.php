<?php
/**
 * @version $Header: /cvsroot/bitweaver/_bit_yellowpages/lookup_yellowpages_inc.php,v 1.3 2008/06/19 05:01:38 lsces Exp $
 * $Id: lookup_yellowpages_inc.php,v 1.3 2008/06/19 05:01:38 lsces Exp $
 * 
 * YellowPages class to illustrate best practices when creating a new bitweaver package that
 * builds on core bitweaver functionality, such as the Liberty CMS engine
 *
 * @date created 2004/8/15
 * @author spider <spider@steelsun.com>
 * @package yellowpages
 * @subpackage functions
 */

/**
 * Initialize
 */
global $gContent;
require_once( YELLOWPAGES_PKG_PATH.'YellowPages.php');
require_once( LIBERTY_PKG_PATH.'lookup_content_inc.php' );

// if we already have a gContent, we assume someone else created it for us, and has properly loaded everything up.
if( empty( $gContent ) || !is_object( $gContent ) || !$gContent->isValid() ) {
	// if yellowpages_id supplied, use that
	if (!empty($_REQUEST['yellowpages_id']) && is_numeric($_REQUEST['yellowpages_id'])) {
		$gContent = new YellowPages( $_REQUEST['yellowpages_id'] );

		// if content_id supplied, use that
	} elseif (!empty($_REQUEST['content_id']) && is_numeric($_REQUEST['content_id'])) {
		$gContent = new YellowPages( NULL, $_REQUEST['content_id'] );

		// otherwise create new object
	} else {
		$gContent = new YellowPages();
	}

	//handle legacy forms that use plain 'yellowpages' form variable name
	// TODO not sure what this does - wolff_borg
	if( empty( $gContent->mYellowPagesId ) && empty( $gContent->mContentId )  ) {
	}
	$gContent->load();
	$gBitSmarty->assign_by_ref( "gContent", $gContent );
}
?>
