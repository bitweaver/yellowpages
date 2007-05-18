<?php

$tables = array(
	'yellowpages' => "
		yellowpages_id I4 PRIMARY,
		content_id I4 NOTNULL,
		associated_content_id 14,
		yellowpages_group_id 14,
		firstname C(160),
		lastname C(160),
		url C(250),
		url_title C(160),
		email_1 C(160),
		email_2 C(160),
		im_id C(32),
		im_type C(32),
		address_1 C(160),
		address_2 C(160),
		city C(160),
		region C(160),
		country C(160),
		postal_code C(16)
		CONSTRAINT ', CONSTRAINT `yellowpages_content_id_ref` FOREIGN KEY (`content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)
					, CONSTRAINT `yellowpages_associated_id_ref` FOREIGN KEY (`associated_content_id`) REFERENCES `".BIT_DB_PREFIX."liberty_content` (`content_id`)'
	",

	'yellowpages_phones' => "
		yellowpages_id I4 NOTNULL,
		phone_type C(32) NOTNULL,
		phone_areacode C(32),
		phone_number C(32) NOTNULL
		CONSTRAINT ', CONSTRAINT `yellowpages_phones_ref` FOREIGN KEY (`yellowpages_id`) REFERENCES `".BIT_DB_PREFIX."yellowpages` (`yellowpages_id`)'
	",

	'yellowpages_groups' => "
		group_id I4 NOTNULL,
		yellowpages_master_id I4 NOTNULL
		CONSTRAINT ', CONSTRAINT `yellowpages_master_ref` FOREIGN KEY (`yellowpages_master_id`) REFERENCES `".BIT_DB_PREFIX."yellowpages` (`yellowpages_id`)'
	",

	'yellowpages_hours' => "
		yellowpages_id I4 NOTNULL,
		day_id I4 NOTNULL,
		start_time I8,
		end_time I8,
		twentyfour C(1) DEFAULT 'n',
		note C(250)
		CONSTRAINT ', CONSTRAINT `yellowpages_day_id_ref` FOREIGN KEY (`day_id`) REFERENCES `".BIT_DB_PREFIX."yellowpages_days` (`day_id`)'
	",

	'yellowpages_days' => "
		day_id I4 NOTNULL,
		day_name C(160) NOTNULL
	",
);

global $gBitInstaller;

//VERIFY Installer said to remove
//$gBitInstaller->makePackageHomeable( YELLOWPAGES_PKG_NAME );

foreach( array_keys( $tables ) AS $tableName ) {
    $gBitInstaller->registerSchemaTable( YELLOWPAGES_PKG_NAME, $tableName, $tables[$tableName] );
}

$gBitInstaller->registerPackageInfo( YELLOWPAGES_PKG_NAME, array(
	'description' => "YellowPages package manages listings.",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
	'version' => '0.1',
	'state' => 'alpha',
	'dependencies' => '',
) );

// ### Indexes
$indices = array(
	'yellowpages_yellowpages_id_idx' => array('table' => 'yellowpages', 'cols' => 'yellowpages_id', 'opts' => NULL ),
	'yellowpages_group_id_idx' => array('table' => 'yellowpages_groups', 'cols' => 'group_id', 'opts' => NULL ),
);
$gBitInstaller->registerSchemaIndexes( YELLOWPAGES_PKG_NAME, $indices );

// ### Sequences
$sequences = array (
	'yellowpages_id_seq' => array( 'start' => 1 ),
	'yellowpages_group_id_seq' => array( 'start' => 1 ),
	'yellowpages_day_id_seq' => array( 'start' => 100 )
);
$gBitInstaller->registerSchemaSequences( YELLOWPAGES_PKG_NAME, $sequences );

// ### Defaults
$gBitInstaller->registerSchemaDefault( YELLOWPAGES_PKG_NAME, array(
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 0, 'Monday' ) ",
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 1, 'Tuesday' ) ",
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 2, 'Wednesday' ) ",
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 3, 'Thursday' ) ",
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 4, 'Friday' ) ",
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 5, 'Saturday' ) ",
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 6, 'Sunday' ) ",
	"INSERT INTO `".BIT_DB_PREFIX."yellowpages_days` ( `day_id`, `day_title` ) VALUES ( 7, 'Holidays' ) ",
));

// ### Default UserPermissions
$gBitInstaller->registerUserPermissions( YELLOWPAGES_PKG_NAME, array(
	array( 'p_admin_yellowpages', 'Can admin yellowpages', 'admin', YELLOWPAGES_PKG_NAME ),
	array( 'p_create_yellowpages', 'Can create yellowpages', 'registered', YELLOWPAGES_PKG_NAME ),
	array( 'p_edit_yellowpages', 'Can edit yellowpages', 'editors', YELLOWPAGES_PKG_NAME ),
	array( 'p_read_yellowpages', 'Can read yellowpages', 'basic',  YELLOWPAGES_PKG_NAME ),
	array( 'p_remove_yellowpages', 'Can delete yellowpages', 'admin',  YELLOWPAGES_PKG_NAME ),
));

// ### Default Preferences
$gBitInstaller->registerPreferences( YELLOWPAGES_PKG_NAME, array(
	//array( YELLOWPAGES_PKG_NAME, 'yellowpages_max_list', '30' ),
));
?>
