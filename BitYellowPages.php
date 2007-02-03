<?php
/**
* $Header: /cvsroot/bitweaver/_bit_yellowpages/Attic/BitYellowPages.php,v 1.1 2007/02/03 19:56:56 spiderr Exp $
* $Id: BitYellowPages.php,v 1.1 2007/02/03 19:56:56 spiderr Exp $
*/

/**
* YellowPages class to illustrate best practices when creating a new bitweaver package that
* builds on core bitweaver functionality, such as the Liberty CMS engine
*
* @date created 2004/8/15
* @author spider <spider@steelsun.com>
* @version $Revision: 1.1 $ $Date: 2007/02/03 19:56:56 $ $Author: spiderr $
* @class BitYellowPages
*/

require_once( LIBERTY_PKG_PATH.'LibertyAttachable.php' );

/**
* This is used to uniquely identify the object
*/
define( 'BITYELLOWPAGES_CONTENT_TYPE_GUID', 'bityellowpages' );

class BitYellowPages extends LibertyAttachable {
	/**
	* Primary key for our mythical YellowPages class object & table
	* @public
	*/
	var $mYellowPagesId;

	/**
	* During initialisation, be sure to call our base constructors
	**/
	function BitYellowPages( $pYellowPagesId=NULL, $pContentId=NULL ) {
		LibertyAttachable::LibertyAttachable();
		$this->mYellowPagesId = $pYellowPagesId;
		$this->mContentId = $pContentId;
		$this->mContentTypeGuid = BITYELLOWPAGES_CONTENT_TYPE_GUID;
		$this->registerContentType( BITYELLOWPAGES_CONTENT_TYPE_GUID, array(
			'content_type_guid' => BITYELLOWPAGES_CONTENT_TYPE_GUID,
			'content_description' => 'YellowPages package with bare essentials',
			'handler_class' => 'BitYellowPages',
			'handler_package' => 'yellowpages',
			'handler_file' => 'BitYellowPages.php',
			'maintainer_url' => 'http://www.bitweaver.org'
		) );
	}

	/**
	* Load the data from the database
	* @param pParamHash be sure to pass by reference in case we need to make modifcations to the hash
	**/
	function load() {
		if( !empty( $this->mYellowPagesId ) || !empty( $this->mContentId ) ) {
			// LibertyContent::load()assumes you have joined already, and will not execute any sql!
			// This is a significant performance optimization
			$lookupColumn = !empty( $this->mYellowPagesId )? 'yellowpages_id' : 'content_id';
			$lookupId = !empty( $this->mYellowPagesId )? $this->mYellowPagesId : $this->mContentId;
			$query = "SELECT ts.*, tc.*, " .
			"uue.`login` AS modifier_user, uue.`real_name` AS modifier_real_name, " .
			"uuc.`login` AS creator_user, uuc.`real_name` AS creator_real_name " .
			"FROM `".BIT_DB_PREFIX."bit_yellowpagess` ts " .
			"INNER JOIN `".BIT_DB_PREFIX."tiki_content` tc ON( tc.`content_id` = ts.`content_id` )" .
			"LEFT JOIN `".BIT_DB_PREFIX."users_users` uue ON( uue.`user_id` = tc.`modifier_user_id` )" .
			"LEFT JOIN `".BIT_DB_PREFIX."users_users` uuc ON( uuc.`user_id` = tc.`user_id` )" .
			"WHERE ts.`$lookupColumn`=?";
			$result = $this->mDb->query( $query, array( $lookupId ) );

			if( $result && $result->numRows() ) {
				$this->mInfo = $result->fields;
				$this->mContentId = $result->fields['content_id'];
				$this->mYellowPagesId = $result->fields['yellowpages_id'];

				$this->mInfo['creator'] =( isset( $result->fields['creator_real_name'] )? $result->fields['creator_real_name'] : $result->fields['creator_user'] );
				$this->mInfo['editor'] =( isset( $result->fields['modifier_real_name'] )? $result->fields['modifier_real_name'] : $result->fields['modifier_user'] );
				$this->mInfo['display_url'] = $this->getDisplayUrl();

				LibertyAttachable::load();
			}
		}
		return( count( $this->mInfo ) );
	}

	/**
	* Any method named Store inherently implies data will be written to the database
	* @param pParamHash be sure to pass by reference in case we need to make modifcations to the hash
	* This is the ONLY method that should be called in order to store( create or update )an yellowpages!
	* It is very smart and will figure out what to do for you. It should be considered a black box.
	*
	* @param array pParams hash of values that will be used to store the page
	*
	* @return bool TRUE on success, FALSE if store could not occur. If FALSE, $this->mErrors will have reason why
	*
	* @access public
	**/
	function store( &$pParamHash ) {
		if( $this->verify( $pParamHash )&& LibertyAttachable::store( $pParamHash ) ) {
			$table = BIT_DB_PREFIX."bit_yellowpagess";
			$this->mDb->StartTrans();
			if( $this->mYellowPagesId ) {
				$locId = array( "name" => "yellowpages_id", "value" => $pParamHash['yellowpages_id'] );
				$result = $this->mDb->associateUpdate( $table, $pParamHash['yellowpages_store'], $locId );
			} else {
				$pParamHash['yellowpages_store']['content_id'] = $pParamHash['content_id'];
				if( isset( $pParamHash['yellowpages_id'] )&& is_numeric( $pParamHash['yellowpages_id'] ) ) {
					// if pParamHash['yellowpages_id'] is set, some is requesting a particular yellowpages_id. Use with caution!
					$pParamHash['yellowpages_store']['yellowpages_id'] = $pParamHash['yellowpages_id'];
				} else {
					$pParamHash['yellowpages_store']['yellowpages_id'] = $this->mDb->GenID( 'bit_yellowpagess_yellowpages_id_seq' );
				}
				$this->mYellowPagesId = $pParamHash['yellowpages_store']['yellowpages_id'];

				$result = $this->mDb->associateInsert( $table, $pParamHash['yellowpages_store'] );
			}


			$this->mDb->CompleteTrans();
			$this->load();
		}
		return( count( $this->mErrors )== 0 );
	}

	/**
	* Make sure the data is safe to store
	* @param pParamHash be sure to pass by reference in case we need to make modifcations to the hash
	* This function is responsible for data integrity and validation before any operations are performed with the $pParamHash
	* NOTE: This is a PRIVATE METHOD!!!! do not call outside this class, under penalty of death!
	*
	* @param array pParams reference to hash of values that will be used to store the page, they will be modified where necessary
	*
	* @return bool TRUE on success, FALSE if verify failed. If FALSE, $this->mErrors will have reason why
	*
	* @access private
	**/
	function verify( &$pParamHash ) {
		global $gBitUser, $gBitSystem;

		// make sure we're all loaded up of we have a mYellowPagesId
		if( $this->mYellowPagesId && empty( $this->mInfo ) ) {
			$this->load();
		}

		if( !empty( $this->mInfo['content_id'] ) ) {
			$pParamHash['content_id'] = $this->mInfo['content_id'];
		}

		// It is possible a derived class set this to something different
		if( empty( $pParamHash['content_type_guid'] ) ) {
			$pParamHash['content_type_guid'] = $this->mContentTypeGuid;
		}

		if( !empty( $pParamHash['content_id'] ) ) {
			$pParamHash['yellowpages_store']['content_id'] = $pParamHash['content_id'];
		}

		// check some lengths, if too long, then truncate
		if( $this->isValid()&& !empty( $this->mInfo['description'] )&& empty( $pParamHash['description'] ) ) {
			// someone has deleted the description, we need to null it out
			$pParamHash['yellowpages_store']['description'] = '';
		} else if( empty( $pParamHash['description'] ) ) {
			unset( $pParamHash['description'] );
		} else {
			$pParamHash['yellowpages_store']['description'] = substr( $pParamHash['description'], 0, 200 );
		}

		if( !empty( $pParamHash['data'] ) ) {
			$pParamHash['edit'] = $pParamHash['data'];
		}

		// check for name issues, first truncate length if too long
		if( !empty( $pParamHash['title'] ) ) {
			if( empty( $this->mYellowPagesId ) ) {
				if( empty( $pParamHash['title'] ) ) {
					$this->mErrors['title'] = 'You must enter a name for this page.';
				} else {
					$pParamHash['content_store']['title'] = substr( $pParamHash['title'], 0, 160 );
				}
			} else {
				$pParamHash['content_store']['title'] =( isset( $pParamHash['title'] ) )? substr( $pParamHash['title'], 0, 160 ): '';
			}
		} else if( empty( $pParamHash['title'] ) ) {
			// no name specified
			$this->mErrors['title'] = 'You must specify a name';
		}

		return( count( $this->mErrors )== 0 );
	}

	/**
	* This function removes a yellowpages entry
	**/
	function expunge() {
		$ret = FALSE;
		if( $this->isValid() ) {
			$this->mDb->StartTrans();
			$query = "DELETE FROM `".BIT_DB_PREFIX."bit_yellowpagess` WHERE `content_id` = ?";
			$result = $this->mDb->query( $query, array( $this->mContentId ) );
			if( LibertyAttachable::expunge() ) {
				$ret = TRUE;
				$this->mDb->CompleteTrans();
			} else {
				$this->mDb->RollbackTrans();
			}
		}
		return $ret;
	}

	/**
	* Make sure yellowpages is loaded and valid
	**/
	function isValid() {
		return( !empty( $this->mYellowPagesId ) );
	}

	/**
	* This function generates a list of records from the tiki_content database for use in a list page
	**/
	function getList( &$pParamHash ) {
		LibertyContent::prepGetList( $pParamHash );

		$find = $pParamHash['find'];
		$sort_mode = $pParamHash['sort_mode'];
		$max_records = $pParamHash['max_records'];
		$offset = $pParamHash['offset'];

		if( is_array( $find ) ) {
			// you can use an array of pages
			$mid = " WHERE tc.`title` IN( ".implode( ',',array_fill( 0,count( $find ),'?' ) )." )";
			$bindvars = $find;
		} else if( is_string( $find ) ) {
			// or a string
			$mid = " WHERE UPPER( tc.`title` )like ? ";
			$bindvars = array( '%' . strtoupper( $find ). '%' );
		} else if( !empty( $pUserId ) ) {
			// or a string
			$mid = " WHERE tc.`creator_user_id` = ? ";
			$bindvars = array( $pUserId );
		} else {
			$mid = "";
			$bindvars = array();
		}

		$query = "SELECT ts.*, tc.`content_id`, tc.`title`, tc.`data`
			FROM `".BIT_DB_PREFIX."bit_yellowpagess` ts INNER JOIN `".BIT_DB_PREFIX."tiki_content` tc ON( tc.`content_id` = ts.`content_id` )
			".( !empty( $mid )? $mid.' AND ' : ' WHERE ' )." tc.`content_type_guid` = '".BITYELLOWPAGES_CONTENT_TYPE_GUID."'
			ORDER BY ".$this->mDb->convert_sortmode( $sort_mode );
		$query_cant = "select count( * )from `".BIT_DB_PREFIX."tiki_content` tc ".( !empty( $mid )? $mid.' AND ' : ' WHERE ' )." tc.`content_type_guid` = '".BITYELLOWPAGES_CONTENT_TYPE_GUID."'";
		$result = $this->mDb->query( $query,$bindvars,$max_records,$offset );
		$ret = array();
		while( $res = $result->fetchRow() ) {
			$ret[] = $res;
		}
		$pParamHash["data"] = $ret;

		$pParamHash["cant"] = $this->mDb->getOne( $query_cant,$bindvars );

		LibertyContent::postGetList( $pParamHash );
		return $pParamHash;
	}

	/**
	* Generates the URL to the yellowpages page
	* @param pExistsHash the hash that was returned by LibertyContent::pageExists
	* @return the link to display the page.
	*/
	function getDisplayUrl() {
		$ret = NULL;
		if( !empty( $this->mYellowPagesId ) ) {
			$ret = YELLOWPAGES_PKG_URL."index.php?yellowpages_id=".$this->mYellowPagesId;
		}
		return $ret;
	}

}
?>
