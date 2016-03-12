<?php
/**
* Plugin Name: Login Register Widget
* Plugin URI: http://github.com/AlexAlexandru/loginregisterwidget
* Description: Widget for login, register and lost password.
* Version: 1.0
* Author: VortexThemes
* Author URI: https://github.com/AlexAlexandru
* License: GPL2
* Text Domain: loginregisterwidget
* Domain Path: /languages
*/
include(plugin_dir_path(__FILE__).'widget.php');
include(plugin_dir_path(__FILE__).'admin/options.php');

			//register
			$register_widget_settings_options = get_option( 'register_widget_settings_option_name' );
			if(isset($register_widget_settings_options['google_recaptcha_secret_key_0'])){
				$google_recaptcha_secret_key = $register_widget_settings_options['google_recaptcha_secret_key_0'];
			}
			
			if(!empty($google_recaptcha_secret_key)){
				function register_widget_recaptcha_register_errors( $errors, $sanitized_user_login, $user_email ) {
					if(isset($_POST['g-recaptcha-response'])){
						global $google_recaptcha_secret_key;
						$recaptcha = new \ReCaptcha\ReCaptcha($google_recaptcha_secret_key);
						$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
						
						if (!$resp->isSuccess()) {
							$errors->add( 'g-recaptcha-response', sprintf( wp_kses( __( '<strong>ERROR</strong>: Invalid ReCaptcha.', 'loginregisterwidget' ), array(  'strong' => array() ) )) );
							return $errors;
						}
					}
					return $errors;
				}
				//LOST PASSWORD
				function register_widget_recaptcha_lost_errors(){
					if(isset($_POST['g-recaptcha-response'])){
						global $google_recaptcha_secret_key;
						$recaptcha = new \ReCaptcha\ReCaptcha($google_recaptcha_secret_key);
						$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
						if (!$resp->isSuccess()) {
							return new WP_Error( 'g-recaptcha-response', sprintf( wp_kses( __( '<strong>ERROR</strong>: Invalid ReCaptcha.', 'loginregisterwidget' ), array(  'strong' => array() ) )) );
						}
					}
					return true;
					
				}
				//login
				function register_widget_recaptcha_login_errors( $user ){
					if(isset($_POST['g-recaptcha-response'])){
						global $google_recaptcha_secret_key;
						$recaptcha = new \ReCaptcha\ReCaptcha($google_recaptcha_secret_key);
						$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
						if (!$resp->isSuccess()) {
							$user = new WP_Error( 'g-recaptcha-response', sprintf( wp_kses( __( '<strong>ERROR</strong>: Invalid ReCaptcha.', 'loginregisterwidget' ), array(  'strong' => array() ) )) );
							return $user;
						}
					}
					return $user;
				}
			}

		function register_widget_check(){
			load_plugin_textdomain('loginregisterwidget', FALSE, basename(plugin_dir_path(__FILE__)).'/languages' );
			if ( is_active_widget( false, false,'loginregisterwidget', true ) ) {
				function register_widget_enqueue_files(){
					wp_enqueue_script( 'register_widget_main', plugin_dir_url( __FILE__ ).'allinone.js', array('jquery'), '1.0',true);
					wp_enqueue_style( 'register_widget', plugin_dir_url( __FILE__ ).'allinone.css' );
					if (version_compare(PHP_VERSION, '5.3') >= 0){
						wp_enqueue_script( 'google_recaptcha_online','https://www.google.com/recaptcha/api.js?onload=CaptchaCallbackRegister&render=explicit', array('jquery'), '1.0',true);
					}
				}
				add_action('wp_enqueue_scripts','register_widget_enqueue_files');
				
				$register_widget_settings_options   = get_option( 'register_widget_settings_option_name' );
				if(isset($register_widget_settings_options['disable_google_recaptcha_in_widget_3'])){
					$disable_google_recaptcha_in_widget = $register_widget_settings_options['disable_google_recaptcha_in_widget_3'];
				}
				if(isset($register_widget_settings_options['google_recaptcha_secret_key_0'])){
						$google_recaptcha_secret_key = $register_widget_settings_options['google_recaptcha_secret_key_0'];
				}
				if(isset($register_widget_settings_options['google_recaptcha_site_key_1'])){
						$google_recaptcha_site_key = $register_widget_settings_options['google_recaptcha_site_key_1'];
				}

				if (version_compare(PHP_VERSION, '5.3') >= 0 && isset($disable_google_recaptcha_in_widget) && !empty($google_recaptcha_secret_key) && !empty($google_recaptcha_site_key)){
					require(plugin_dir_path(__FILE__).'autoload.php');	
					add_filter('registration_errors', 'register_widget_recaptcha_register_errors', 10, 3 );
					add_filter('allow_password_reset','register_widget_recaptcha_lost_errors');
					add_filter('wp_authenticate_user', 'register_widget_recaptcha_login_errors');
				}
			}
		}
		add_action('init','register_widget_check');
		//REGISTER		
		if (version_compare(PHP_VERSION, '5.3') >= 0){
			$register_widget_settings_options = get_option( 'register_widget_settings_option_name' );
			if(isset($register_widget_settings_options['google_recaptcha_site_key_1'])){
				$google_recaptcha_site_key = $register_widget_settings_options['google_recaptcha_site_key_1'];
			}
			if(isset($register_widget_settings_options['disable_google_recaptcha_in_widget_3'])){
				$disable_google_recaptcha_in_widget = $register_widget_settings_options['disable_google_recaptcha_in_widget_3'];
			}
			if(isset($register_widget_settings_options['google_recaptcha_secret_key_0'])){
				$google_recaptcha_secret_key = $register_widget_settings_options['google_recaptcha_secret_key_0'];
			}
			
			if(isset($register_widget_settings_options['disable_google_recaptcha_in_widget_3_dark'])){
				$dark_theme = $register_widget_settings_options['disable_google_recaptcha_in_widget_3_dark'];
			}
			
			if(!empty($google_recaptcha_site_key) && !empty($google_recaptcha_secret_key) && isset($disable_google_recaptcha_in_widget)){
				function register_widget_recaptcha_register_form() {
					global $google_recaptcha_site_key;
					global $dark_theme;
					$theme = 'light';
					if(isset($dark_theme)){
						$theme = 'dark';
					}
					?>
					
					<p>
						<div data-theme="<?php echo esc_attr($theme)?>" class="g-recaptcha" id="g-recaptcha-register" data-sitekey="<?php echo esc_attr($google_recaptcha_site_key) ?>"></div>
					</p>
					<?php
				}
				function register_widget_recaptcha_lost_form(){
					global $google_recaptcha_site_key;
					global $dark_theme;
					$theme = 'light';
					if(isset($dark_theme)){
						$theme = 'dark';
					}
					?>
					<p>
						<div data-theme="<?php echo esc_attr($theme)?>" class="g-recaptcha" id="g-recaptcha-lost" data-sitekey="<?php echo esc_attr($google_recaptcha_site_key) ?>"></div>
					</p>
					<?php
				}
				//LOG IN 
				function register_widget_recaptcha_login_form(){
					global $google_recaptcha_site_key;
					global $dark_theme;
					$theme = 'light';
					if(isset($dark_theme)){
						$theme = 'dark';
					}
				?>
					<p>
						<div data-theme="<?php echo esc_attr($theme)?>" class="g-recaptcha" id="g-recaptcha-login" data-sitekey="<?php echo esc_attr($google_recaptcha_site_key)?>"></div>
					</p>
				<?php
				}
				add_action('loginregisterwidget_login_form','register_widget_recaptcha_login_form');
				add_action('loginregisterwidget_lostpassword_form','register_widget_recaptcha_lost_form');
				add_action('loginregisterwidget_register_form', 'register_widget_recaptcha_register_form' );
			}

			
		if (isset($disable_google_recaptcha_in_widget) && version_compare(PHP_VERSION, '5.3') >= 0 && !empty($google_recaptcha_site_key) && !empty($google_recaptcha_secret_key)){
			require(plugin_dir_path(__FILE__).'autoload.php');
			add_action('login_form','register_widget_recaptcha_login_form');
			add_action('lostpassword_form','register_widget_recaptcha_lost_form');
			add_action('register_form', 'register_widget_recaptcha_register_form' );
			function register_widget_login_recaptcha(){
				wp_enqueue_script( 'google_recaptcha_online','https://www.google.com/recaptcha/api.js', array('jquery'), '1.0',true);
			}
			add_action('login_enqueue_scripts','register_widget_login_recaptcha');
			add_filter('registration_errors', 'register_widget_recaptcha_register_errors', 10, 3 );
			add_filter('allow_password_reset','register_widget_recaptcha_lost_errors');
			add_filter('wp_authenticate_user', 'register_widget_recaptcha_login_errors');
		}
	}