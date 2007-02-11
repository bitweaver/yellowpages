<?php

$tables = array(
	'yellowpages' => "
		yellowpages_id I4 PRIMARY,
		content_id I4 NOTNULL,
		group_id 14,
		parent_id 14,
		url C(250),
		url_title C(160),
		phone_main C(16),
		phone_mobile C(16),
		fax C(16),
		email C(32),
		im C(32),
		im_type C(32),
		address_1 C(160),
		address_2 C(160),
		city C(160),
		region C(160),
		country C(160),
		postal_code I4
		CONSTRAINT ', CONSTRAINT `yellowpages_content_ref` FOREIGN KEY (`content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)
					, CONSTRAINT `yellowpages_group_id_ref` FOREIGN KEY (`group_id`) REFERENCES `".BIT_DB_PREFIX."yellowpages_groups` (`group_id`)
					, CONSTRAINT `yellowpages_parent_id_ref` FOREIGN KEY (`parent_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)'
	",

	'yellowpages_groups' => "
		group_id I4 NOTNULL,
		king_content_id I4
		CONSTRAINT ', CONSTRAINT `yellowpages_king_content_id_ref` FOREIGN KEY (`king_content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)'
	",

	'yellowpages_hours' => "
		content_id I4 NOTNULL,
		day_id I4 NOTNULL,
		start_time I8,
		end_time I8,
		twentyfour C(5) DEFAULT 'false',
		note C(250)
		CONSTRAINT ', CONSTRAINT `yellowpages_hours_content_ref` FOREIGN KEY (`content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)
					, CONSTRAINT `yellowpages_day_id_ref` FOREIGN KEY (`day_id`) REFERENCES `".BIT_DB_PREFIX."yellowpages_days` (`day_id`)'
	",

	'yellowpages_days' => "
		day_id I4 NOTNULL,
		day_title C(160) NOTNULL
	",
);

global $gBitInstaller;

$gBitInstaller->makePackageHomeable( YELLOWPAGES_PKG_NAME );

foreach( array_keys( $tables ) AS $tableName ) {
    $gBitInstaller->registerSchemaTable( YELLOWPAGES_PKG_NAME, $tableName, $tables[$tableName] );
}

$gBitInstaller->registerPackageInfo( YELLOWPAGES_PKG_NAME, array(
	'description' => "YellowPages package to demonstrate how to build a bitweaver package.",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
	'version' => '0.1',
	'state' => 'beta',
	'dependencies' => '',
) );

// ### Indexes
$indices = array(
	'bit_yellowpagess_yellowpages_id_idx' => array('table' => 'bit_yellowpagess', 'cols' => 'yellowpages_id', 'opts' => NULL ),
);
$gBitInstaller->registerSchemaIndexes( YELLOWPAGES_PKG_NAME, $indices );

/*// ### Sequences
$sequences = array (
	'bit_yellowpages_id_seq' => array( 'start' => 1 )
);
$gBitInstaller->registerSchemaSequences( YELLOWPAGES_PKG_NAME, $sequences );
*/


$gBitInstaller->registerSchemaDefault( YELLOWPAGES_PKG_NAME, array(
	//      "INSERT INTO `".BIT_DB_PREFIX."bit_yellowpages_types` (`type`) VALUES ('YellowPages')",
) );

// ### Default UserPermissions
$gBitInstaller->registerUserPermissions( YELLOWPAGES_PKG_NAME, array(
	array( 'bit_p_admin_yellowpages', 'Can admin yellowpages', 'admin', YELLOWPAGES_PKG_NAME ),
	array( 'bit_p_create_yellowpages', 'Can create a yellowpages', 'registered', YELLOWPAGES_PKG_NAME ),
	array( 'bit_p_edit_yellowpages', 'Can edit any yellowpages', 'editors', YELLOWPAGES_PKG_NAME ),
	array( 'bit_p_read_yellowpages', 'Can read yellowpages', 'basic',  YELLOWPAGES_PKG_NAME ),
	array( 'bit_p_remove_yellowpages', 'Can delete yellowpages', 'admin',  YELLOWPAGES_PKG_NAME ),
) );

// ### Default Preferences
$gBitInstaller->registerPreferences( YELLOWPAGES_PKG_NAME, array(
	array( YELLOWPAGES_PKG_NAME, 'yellowpages_default_ordering', 'yellowpages_id_desc' ),
	array( YELLOWPAGES_PKG_NAME, 'yellowpages_list_yellowpages_id', 'y' ),
	array( YELLOWPAGES_PKG_NAME, 'yellowpages_list_title', 'y' ),
	array( YELLOWPAGES_PKG_NAME, 'yellowpages_list_description', 'y' ),
	array( YELLOWPAGES_PKG_NAME, 'feature_listYellowPagess', 'y' ),
) );
?>
