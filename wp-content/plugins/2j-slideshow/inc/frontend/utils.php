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

if( TWOJ_SLIDESHOW_PRO != 1 ){
	class twojSlideshowParent{ public $pro = 0; }
}

class twojSlideshowUtils extends twojSlideshowParent{
	
	public function compileJavaScript(){
 		return
 		'var '.$this->slideshowId.' = {'.$this->helper->getOptionList().'}, '.$this->slideshowId.'_css = "'.$this->javaScriptStyle.'",
		head = document.head || document.getElementsByTagName("head")[0],
		style = document.createElement("style");
		style.type = "text/css";
		if (style.styleSheet) style.styleSheet.cssText = '.$this->slideshowId.'_css;
			else  style.appendChild(document.createTextNode('.$this->slideshowId.'_css));
		head.appendChild(style);';
 	}

}