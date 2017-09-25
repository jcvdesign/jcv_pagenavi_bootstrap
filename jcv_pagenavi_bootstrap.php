<?php
/*
Plugin Name: Pagenavi / Bootstrap 4
Plugin URI: https://plugins.jcv.design/pagenavi-bootstrap
Description: Plugin para formatar as paginações do plugin Pagenavi com os estilos do Bootstrap 4.x.
Version: 0.1b
Author: jcv.design
Author URI: https://jcv.design
Text Domain: jcv_pagenavi_bootstrap
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Jcv_Pagenavi_Bootstrap') ) :
define('CLASS_NAME', 'Jcv_Pagenavi_Bootstrap');
define('OPTIONS', 'jcv-pagenavi-bootstrap-options');
define('OPREFIX', 'jcv_pagenavi_bootstrap_');
	  
class Jcv_Pagenavi_Bootstrap{
	  
	  
			private static $instance = null;
			
			
			public function init(){
				  if(self::$instance == null)
				  		self::$instance = new static();
			}
			
			protected function __construct(){
			
				  $this->settings = [
									  'name'	 => __('Pagenavi / Bootstrap', 'jcv_pagenavi_bootstrap'),
									  'file'	 => __FILE__,
									  'basename' => plugin_basename( __FILE__ ),
									  'path'	 => plugin_dir_path( __FILE__ ),
									  'dir'		 => plugin_dir_url( __FILE__ )
								];
				  
				  
				  add_filter( 'wp_pagenavi', [CLASS_NAME, '_replace_code'], 12, 2 );
				  add_action('admin_menu', array(CLASS_NAME, 'admin_menu'));
			
			}
			
			public function _replace_code($html) {
				  $html = preg_replace('/(<span class=\'pages\'>.+?)+(<\/span>)/i', '', $html);
				  
				  $out = '';
				  $out = str_replace('<div','',$html);
				  $out = str_replace("class='wp-pagenavi'>",'',$out);
				  $out = str_replace('<a','<li class="page-item"><a class="page-link"',$out);
				  $out = str_replace('</a>','</a></li>',$out);
				  $out = str_replace("<span class='current'",'<li class="page-item active"><span class="page-link current"',$out);
				  $out = str_replace("<span class='extend'",'<li class="page-item"><span class="page-link extend"',$out);
				  $out = str_replace('</span>','</span></li>',$out);
				  $out = str_replace('</div>','',$out);
				  return '<div class="jcv-pagination '.self::getOption('custom_class').'"><ul class="pagination '.self::getOption('size').' '.self::getOption('align').'">'.$out.'</ul></div>';
			}
			
	  
			function admin_menu(){
				
				  add_menu_page(  'jcv.design',
								  'jcv.design',
								  'manage_options',
								  'jcvdev-menu',
								  array(CLASS_NAME,'jcv_pagenavi_bootstrap_form_settings_page') ,
								  'dashicons-plus-alt'
							   );
				
				  add_submenu_page('jcvdev-menu', 'jcv.design | Geral', 'Geral', 'manage_options', 'jcvdev-menu' );
				  add_submenu_page('jcvdev-menu', 'jcv.design | Pagenavi / Bootstrap', 'Pagenavi / Bootstrap', 'manage_options', __FILE__ , array(CLASS_NAME,'jcv_pagenavi_bootstrap_form_settings_page') );
				
				  add_action( 'admin_init', array('jcv_pagenavi_bootstrap', 'register_plugin_settings'));
			}
			
			function getOption($option){
				  return esc_attr(get_option(OPREFIX.$option));
			}
			
			function register_plugin_settings() {
				  register_setting( OPTIONS, OPREFIX.'custom_class' );
				  register_setting( OPTIONS, OPREFIX.'align' );
				  register_setting( OPTIONS, OPREFIX.'size' );
			}
			
			function jcv_pagenavi_bootstrap_form_settings_page(){
				  require 'includes/form-options.php';
			}
		
		
	  
	  
}


Jcv_Pagenavi_Bootstrap::init();

endif; // class_exists check