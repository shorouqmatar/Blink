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

class TwojSlideShowReport{
    protected $postType;
    protected $assetsUri;
    public function __construct($postType){
        $this->postType = $postType;
        $this->assetsUri = plugin_dir_url(__FILE__);
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    public function enqueueScripts(){ 
        if ( 
        		twoj_slideshow_get_current_post_type() == $this->postType && 
        		twoj_slideshow_is_edit_page('list') 
        ) {
            wp_enqueue_script(
	            'twoj-slideshow-report-js',
	            $this->assetsUri . '/js/script.js',
	            array(),
	            false,
	            true
	        );
        }
    }
}
