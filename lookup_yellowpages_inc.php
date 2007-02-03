<?php
	global $gContent;
	require_once( YELLOWPAGES_PKG_PATH.'BitYellowPages.php');
	require_once( LIBERTY_PKG_PATH.'lookup_content_inc.php' );

	// if we already have a gContent, we assume someone else created it for us, and has properly loaded everything up.
	if( empty( $gContent ) || !is_object( $gContent ) || !$gContent->isValid() ) {
		// if yellowpages_id supplied, use that
		if (!empty($_REQUEST['yellowpages_id']) && is_numeric($_REQUEST['yellowpages_id'])) {
			$gContent = new BitYellowPages( $_REQUEST['yellowpages_id'] );

		// if content_id supplied, use that
		} elseif (!empty($_REQUEST['content_id']) && is_numeric($_REQUEST['content_id'])) {
			$gContent = new BitYellowPages( NULL, $_REQUEST['content_id'] );

		// otherwise create new object
		} else {
			$gContent = new BitYellowPages();
		}

		//handle legacy forms that use plain 'yellowpages' form variable name
		// TODO not sure what this does - wolff_borg
		if( empty( $gContent->mYellowPagesId ) && empty( $gContent->mContentId )  ) {
		}
		$gContent->load();
		$gBitSmarty->assign_by_ref( "gContent", $gContent );
	}
?>
