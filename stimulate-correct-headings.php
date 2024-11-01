<?php
/*
Plugin Name: Stimulate Correct Headings
Plugin URI: https://github.com/bassjobsen/stimulate-correct-headings
Description: Stimulate editors to use correct headings for accessibility and seo
Version: 1.0
Author: Bass Jobsen
Author URI: http://bassjobsen.weblogs.fm/
License: GPLv2
*/

/*  Copyright 2013 Bass Jobsen (email : bass@w3masters.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if(!class_exists('Stimulate_Correct_Headings')) 
{ 
	
class Stimulate_Correct_Headings 
{ 
/*
* Construct the plugin object 
*/ 
public function __construct() 
{ 
	load_plugin_textdomain( 'sch', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	add_filter( 'init', array( $this, 'init' ) );
} 
// END public 

/** 
 * Activate the plugin 
**/ 
public static function activate() 
{ 
	// Do nothing 
} 
// END public static function activate 

/** 
 * Deactivate the plugin 
 * 
**/ 
public static function deactivate() 

{ // Do nothing 
} 
// END public static function deactivate 

/** 
 * hook into WP's admin_init action hook 
 * */ 
 
public function admin_init() 
{ 
	// Set up the settings for this plugin 
	
	$this->init_settings(); 
	// Possibly do additional admin_init tasks 
} 
// END public static function activate - See more at: http://www.yaconiello.com/blog/how-to-write-wordpress-plugin/#sthash.mhyfhl3r.JacOJxrL.dpuf

/** * Initialize some custom settings */ 
public function init_settings() 
{ 
	// register the settings for this plugin 

} // END public function init_custom_settings()



function init()
{
	if (is_admin() ) :
	function my_mce_buttons_1($buttons) 
	{	
	$buttons = array_merge(array('formatselect'),$buttons);
	return $buttons;
	}
	add_filter('mce_buttons', 'my_mce_buttons_1');
	
	// add more buttons to the html editor
	function appthemes_add_quicktags() {
		if (wp_script_is('quicktags')){
	?>
    <script type="text/javascript">
    for(var i = 1; i<7; i++)
    {
		//koptekst
		QTags.addButton( 'eg_heading'+i, 'h'+i, '<h'+i+'>', '</h'+i+'>', 'h'+i, '<?php echo __('Heading')?>'+i, i );
	}	
    QTags.addButton( 'eg_paragraph', 'p', '<p>', '</p>', 'p', 'Paragraph tag', (i+1) );
    </script>
	<?php
		}
	}
	add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );
	
	
	function myformatTinyMCE($in)
	{
     $in['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4,h5,h6,pre,address';
	 return $in;
	}
	add_filter('tiny_mce_before_init', 'myformatTinyMCE' );
	
	endif;

}



} // END class 

}

if(class_exists('Stimulate_Correct_Headings')) 
{ // Installation and uninstallation hooks 
	register_activation_hook(__FILE__, array('WooCommerce_Twitter_Bootstrap', 'activate')); 
	register_deactivation_hook(__FILE__, array('WooCommerce_Twitter_Bootstrap', 'deactivate')); 
	
	$woocommercetwitterbootstrap = new Stimulate_Correct_Headings();
}
