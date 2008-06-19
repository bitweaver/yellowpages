<?php
/**
 * @version $Header: /cvsroot/bitweaver/_bit_yellowpages/list_yellowpages.php,v 1.3 2008/06/19 05:01:58 lsces Exp $
 * $Id: list_yellowpages.php,v 1.3 2008/06/19 05:01:58 lsces Exp $
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
require_once('../bit_setup_inc.php' );
require_once(YELLOWPAGES_PKG_PATH.'YellowPages.php' );

// Is package installed and enabled
$gBitSystem->verifyPackage('yellowpages' );

// Now check permissions to access this page
$gBitSystem->verifyPermission('p_read_yellowpages' );

/* mass-remove:
   the checkboxes are sent as the array $_REQUEST["checked[]"], values are the wiki-PageNames,
   e.g. $_REQUEST["checked"][3]="HomePage"
   $_REQUEST["submit_mult"] holds the value of the "with selected do..."-option list
   we look if any page's checkbox is on and if remove_yellowpagess is selected.
   then we check permission to delete yellowpagess.
   if so, we call histlib's method remove_all_versions for all the checked yellowpagess.
*/
if (isset($_REQUEST["submit_mult"]) && isset($_REQUEST["checked"]) && $_REQUEST["submit_mult"] == "remove_yellowpagess") {
        

        // Now check permissions to remove the selected yellowpagess
        $gBitSystem->verifyPermission( 'p_remove_yellowpages' );
                                                                                                                                                                            
        if( !empty( $_REQUEST['cancel'] ) ) {
                // user cancelled - just continue on, doing nothing
        } elseif( empty( $_REQUEST['confirm'] ) ) {
                $formHash['delete'] = TRUE;
                $formHash['submit_mult'] = 'remove_yellowpages';
                foreach( $_REQUEST["checked"] as $del ) {
                        $formHash['input'][] = '<input type="hidden" name="checked[]" value="'.$del.'"/>';
                }
                $gBitSystem->confirmDialog( $formHash, array( 'warning' => 'Are you sure you want to delete '.count($_REQUEST["checked"]).' yellowpages?', 'error' => 'This cannot be undone!' ) );
        } else {
                foreach ($_REQUEST["checked"] as $deleteId) {
                        $tmpPage = new YellowPages( $deleteId );
                        if( !$tmpPage->load() || !$tmpPage->expunge() ) {
                                array_merge( $errors, array_values( $tmpPage->mErrors ) );
                        }
                }
                if( !empty( $errors ) ) {
                        $gBitSmarty->assign_by_ref( 'errors', $errors );
                }
        }
}


$yellowpages = new YellowPages();
$listyellowpagess = $yellowpages->getList( $_REQUEST );



$gBitSmarty->assign_by_ref('control', $_REQUEST["control"]);
$gBitSmarty->assign_by_ref('list', $listyellowpagess["data"]);

// Display the template
$gBitSystem->display('bitpackage:yellowpages/list_yellowpages.tpl', tra('YellowPages') );

?>
