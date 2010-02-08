<?php
/**
 * @version $Header: /cvsroot/bitweaver/_bit_yellowpages/edit.php,v 1.8 2010/02/08 21:27:27 wjames5 Exp $
 * $Id: edit.php,v 1.8 2010/02/08 21:27:27 wjames5 Exp $
 * 
 * YellowPages class to illustrate best practices when creating a new bitweaver package that
 * builds on core bitweaver functionality, such as the Liberty CMS engine
 *
 * date created 2004/8/15
 * @author spider <spider@steelsun.com>
 * @package yellowpages
 * @subpackage functions
 */

/**
 * Initialize
 */
require_once('../kernel/setup_inc.php' );

// Is package installed and enabled
$gBitSystem->verifyPackage('yellowpages' );

// Now check permissions to access this page
$gBitSystem->verifyPermission('p_edit_yellowpages' );

require_once(YELLOWPAGES_PKG_PATH.'lookup_yellowpages_inc.php' );

$countries = array(
	"Afghanistan",
	"Albania",
	"Algeria",
	"American Samoa",
	"Andorra",
	"Angola",
	"Anguilla",
	"Antarctica",
	"Antigua and Barbuda",
	"Argentina",
	"Armenia",
	"Aruba",
	"Australia",
	"Austria",
	"Azerbaijan",
	"Bahamas",
	"Bahrain",
	"Bangladesh",
	"Barbados",
	"Belarus",
	"Belgium",
	"Belize",
	"Benin",
	"Bermuda",
	"Bhutan",
	"Bolivia",
	"Bosnia and Herzegowina",
	"Botswana",
	"Bouvet Island",
	"Brazil",
	"British Indian Ocean Terr.",
	"Brunei Darussalam",
	"Bulgaria",
	"Burkina Faso",
	"Burundi",
	"Cambodia",
	"Cameroon",
	"Canada",
	"Cape Verde",
	"Cayman Islands",
	"Central African Republic",
	"Chad",
	"Chile",
	"China",
	"Christmas Island",
	"Cocos (Keeling) Islands",
	"Colombia",
	"Comoros",
	"Congo",
	"Cook Islands",
	"Costa Rica",
	"Cote d'Ivoire",
	"Croatia (Hrvatska)",
	"Cuba",
	"Cyprus",
	"Czech Republic",
	"Denmark",
	"Djibouti",
	"Dominica",
	"Dominican Republic",
	"East Timor",
	"Ecuador",
	"Egypt",
	"El Salvador",
	"Equatorial Guinea",
	"Eritrea",
	"Estonia",
	"Ethiopia",
	"Falkland Islands/Malvinas",
	"Faroe Islands",
	"Fiji",
	"Finland",
	"France",
	"France, Metropolitan",
	"French Guiana",
	"French Polynesia",
	"French Southern Terr.",
	"Gabon",
	"Gambia",
	"Georgia",
	"Germany",
	"Ghana",
	"Gibraltar",
	"Greece",
	"Greenland",
	"Grenada",
	"Guadeloupe",
	"Guam",
	"Guatemala",
	"Guinea",
	"Guinea-Bissau",
	"Guyana",
	"Haiti",
	"Heard & McDonald Is.",
	"Honduras",
	"Hong Kong",
	"Hungary",
	"Iceland",
	"India",
	"Indonesia",
	"Iran",
	"Iraq",
	"Ireland",
	"Israel",
	"Italy",
	"Jamaica",
	"Japan",
	"Jordan",
	"Kazakhstan",
	"Kenya",
	"Kiribati",
	"Korea, North",
	"Korea, South",
	"Kuwait",
	"Kyrgyzstan",
	"Lao People's Dem. Rep.",
	"Latvia",
	"Lebanon",
	"Lesotho",
	"Liberia",
	"Libyan Arab Jamahiriya",
	"Liechtenstein",
	"Lithuania",
	"Luxembourg",
	"Macau",
	"Macedonia",
	"Madagascar",
	"Malawi",
	"Malaysia",
	"Maldives",
	"Mali",
	"Malta",
	"Marshall Islands",
	"Martinique",
	"Mauritania",
	"Mauritius",
	"Mayotte",
	"Mexico",
	"Micronesia",
	"Moldova",
	"Monaco",
	"Mongolia",
	"Montserrat",
	"Morocco",
	"Mozambique",
	"Myanmar",
	"Namibia",
	"Nauru",
	"Nepal",
	"Netherlands",
	"Netherlands Antilles",
	"New Caledonia",
	"New Zealand",
	"Nicaragua",
	"Niger",
	"Nigeria",
	"Niue",
	"Norfolk Island",
	"Northern Mariana Is.",
	"Norway",
	"Oman",
	"Pakistan",
	"Palau",
	"Panama",
	"Papua New Guinea",
	"Paraguay",
	"Peru",
	"Philippines",
	"Pitcairn",
	"Poland",
	"Portugal",
	"Puerto Rico",
	"Qatar",
	"Reunion",
	"Romania",
	"Russian Federation",
	"Rwanda",
	"Saint Kitts and Nevis",
	"Saint Lucia",
	"St. Vincent & Grenadines",
	"Samoa",
	"San Marino",
	"Sao Tome & Principe",
	"Saudi Arabia",
	"Senegal",
	"Seychelles",
	"Sierra Leone",
	"Singapore",
	"Slovakia (Slovak Republic)",
	"Slovenia",
	"Solomon Islands",
	"Somalia",
	"South Africa",
	"S.Georgia & S.Sandwich Is.",
	"Spain",
	"Sri Lanka",
	"St. Helena",
	"St. Pierre & Miquelon",
	"Sudan",
	"Suriname",
	"Svalbard & Jan Mayen Is.",
	"Swaziland",
	"Sweden",
	"Switzerland",
	"Syrian Arab Republic",
	"Taiwan",
	"Tajikistan",
	"Tanzania",
	"Thailand",
	"Togo",
	"Tokelau",
	"Tonga",
	"Trinidad and Tobago",
	"Tunisia",
	"Turkey",
	"Turkmenistan",
	"Turks & Caicos Islands",
	"Tuvalu",
	"Uganda",
	"Ukraine",
	"United Arab Emirates",
	"United Kingdom",
	"United States",
	"U.S. Minor Outlying Is.",
	"Uruguay",
	"Uzbekistan",
	"Vanuatu",
	"Vatican (Holy See)",
	"Venezuela",
	"Viet Nam",
	"Virgin Islands (British)",
	"Virgin Islands (U.S.)",
	"Wallis & Futuna Is.",
	"Western Sahara",
	"Yemen",
	"Yugoslavia",
	"Zaire",
	"Zambia",
	"Zimbabwe",
);
asort( $countries );
$gBitSmarty->assign( 'countries', $countries );

$imTypes = array(
	"",
	"ICQ",
	"Jabber",
	"Windows Live Messenger",
	"Yahoo Messenger",
	"AIM (AOL Instant Messenger)",
	"IAX (Inter-Asterisk Exchange)",
	"Gadu-Gadu",
	"Ebuddy",
	"Skype",
	"QQ",
	"Sametime",
);
asort( $imTypes );
$gBitSmarty->assign( 'imTypes', $imTypes );

// Check if the page has changed
if (!empty($_REQUEST["save_yellowpages"])) {
    
    // Check if all Request values are delivered, and if not, set them
    // to avoid error messages. This can happen if some features are
    // disabled
    if ($gContent->store( $_REQUEST ) ) {
        header("Location: ".$gContent->getDisplayUrl() );
        die;
    } else {
        $gBitSmarty->assign_by_ref('errors', $gContent->mErrors );
    }
}

// Configure quicktags list
if ($gBitSystem->isPackageActive( 'quicktags' ) ) {
	include_once( QUICKTAGS_PKG_PATH.'quicktags_inc.php' );
}

// WYSIWYG and Quicktag variable
$gBitSmarty->assign( 'textarea_id', 'edityellowpages' );

// Display the template
$gBitSystem->display('bitpackage:yellowpages/edit_yellowpages.tpl', tra('YellowPages') , array( 'display_mode' => 'edit' ));
?>
