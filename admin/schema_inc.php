<?php

$tables = array(
	'bit_yellowpagess' => "
		yellowpages_id I4 AUTO PRIMARY,
		content_id I4 NOTNULL,
		description C(160)
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
