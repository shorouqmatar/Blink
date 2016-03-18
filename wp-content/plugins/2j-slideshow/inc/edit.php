<?php
/*  
 * 2J SlideShow		http://2joomla.net/wordpress
 * Version:           1.3.0 - 59512
 * Author:            2J Team (c)
 * Author URI:        http://2joomla.net/wordpress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Date:              Sun, 07 Feb 2016 08:49:05 GMT
 */

function twoj_slideshow_group_metabox() {

	function twoj_slideshow_set_checkbox_default_for_new_post( $default ) {
		return twoj_slideshow_is_edit_page('edit') ? '' : ( $default ? (string) $default : '' );
	}

    /* if( twoj_slideshow_is_edit_page('edit') ){ } */

    twoj_slideshow_include( 
    		array( 'images.php', 'size.php',  'interface.php', 'animation.php', 'general.php' ), TWOJ_SLIDESHOW_OPTIONS_PATH);
	
	if( !TWOJ_SLIDESHOW_PRO ) twoj_slideshow_include('premium_version.php', TWOJ_SLIDESHOW_OPTIONS_PATH);
}
add_action( 'cmb2_init', 'twoj_slideshow_group_metabox' );