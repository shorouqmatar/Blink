<?php 
class RegisterWidgetSettings {
	private $register_widget_settings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_widget_settings_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'register_widget_settings_page_init' ) );
	}

	public function register_widget_settings_add_plugin_page() {
		add_options_page(
			__('Login, Register Widget Settings','loginregisterwidget'), // page_title
			__('Login, Register Widget Settings','loginregisterwidget'), // menu_title
			'manage_options', // capability
			'register-widget-settings', // menu_slug
			array( $this, 'register_widget_settings_create_admin_page' ) // function
		);
	}

	public function register_widget_settings_create_admin_page() {
		$this->register_widget_settings_options = get_option( 'register_widget_settings_option_name' ); ?>
		
		<div class="wrap">
			<?php echo('<form style="width:260px;margin:0 auto;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<a href="https://wordpress.org/plugins/rating-system/">Rating System free plugin</a>
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="VVGFFVJSFVZ7S">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
					')?>
			<h2><?php _e('Login, Register Widget Settings','loginregisterwidget')?></h2>
			<?php if (version_compare(PHP_VERSION, '5.3','<')){
					printf( __( 'Google ReCaptcha requires at least PHP 5.3 your version is %s update your php version and try again.', 'loginregisterwidget' ), PHP_VERSION );
				}
			?>
			<?php _e('If you want to change the loading icon upload your icon in your current active theme folder with the exact name ajax-loader.gif If you are using a child theme upload in the child theme directory with the name ajax-loader.gif','loginregisterwidget')?>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'register_widget_settings_option_group' );
					do_settings_sections( 'register-widget-settings-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function register_widget_settings_page_init() {
		register_setting(
			'register_widget_settings_option_group', // option_group
			'register_widget_settings_option_name', // option_name
			array( $this, 'register_widget_settings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'register_widget_settings_setting_section', // id
			__('Settings','loginregisterwidget'), // title
			array( $this, 'register_widget_settings_section_info' ), // callback
			'register-widget-settings-admin' // page
		);

		add_settings_field(
			'google_recaptcha_secret_key_0', // id
			__('Google ReCaptcha Secret Key','loginregisterwidget'), // title
			array( $this, 'google_recaptcha_secret_key_0_callback' ), // callback
			'register-widget-settings-admin', // page
			'register_widget_settings_setting_section' // section
		);

		add_settings_field(
			'google_recaptcha_site_key_1', // id
			__('Google ReCaptcha Site key','loginregisterwidget'), // title
			array( $this, 'google_recaptcha_site_key_1_callback' ), // callback
			'register-widget-settings-admin', // page
			'register_widget_settings_setting_section' // section
		);

		add_settings_field(
			'disable_google_recaptcha_in_widget_3', // id
			__('Enable Google Recaptcha','loginregisterwidget'), // title
			array( $this, 'disable_google_recaptcha_in_widget_3_callback' ), // callback
			'register-widget-settings-admin', // page
			'register_widget_settings_setting_section' // section
		);
		add_settings_field(
			'disable_google_recaptcha_in_widget_3_dark', // id
			__('Enable Google Recaptcha Dark Theme','loginregisterwidget'), // title
			array( $this, 'disable_google_recaptcha_in_widget_3_callback_dark' ), // callback
			'register-widget-settings-admin', // page
			'register_widget_settings_setting_section' // section
		);
	}

	public function register_widget_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['google_recaptcha_secret_key_0'] ) ) {
			$sanitary_values['google_recaptcha_secret_key_0'] = sanitize_text_field( $input['google_recaptcha_secret_key_0'] );
		}

		if ( isset( $input['google_recaptcha_site_key_1'] ) ) {
			$sanitary_values['google_recaptcha_site_key_1'] = sanitize_text_field( $input['google_recaptcha_site_key_1'] );
		}

		if ( isset( $input['disable_google_recaptcha_in_widget_3'] ) ) {
			$sanitary_values['disable_google_recaptcha_in_widget_3'] = $input['disable_google_recaptcha_in_widget_3'];
		}
		
		if ( isset( $input['disable_google_recaptcha_in_widget_3_dark'] ) ) {
			$sanitary_values['disable_google_recaptcha_in_widget_3_dark'] = $input['disable_google_recaptcha_in_widget_3_dark'];
		}

		return $sanitary_values;
	}

	public function register_widget_settings_section_info() {
		
	}

	public function google_recaptcha_secret_key_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="register_widget_settings_option_name[google_recaptcha_secret_key_0]" id="google_recaptcha_secret_key_0" value="%s">',
			isset( $this->register_widget_settings_options['google_recaptcha_secret_key_0'] ) ? esc_attr( $this->register_widget_settings_options['google_recaptcha_secret_key_0']) : ''
		);
	}

	public function google_recaptcha_site_key_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="register_widget_settings_option_name[google_recaptcha_site_key_1]" id="google_recaptcha_site_key_1" value="%s">',
			isset( $this->register_widget_settings_options['google_recaptcha_site_key_1'] ) ? esc_attr( $this->register_widget_settings_options['google_recaptcha_site_key_1']) : ''
		);
	}

	public function disable_google_recaptcha_in_widget_3_callback() {
		printf(
			'<input type="checkbox" name="register_widget_settings_option_name[disable_google_recaptcha_in_widget_3]" id="disable_google_recaptcha_in_widget_3" value="disable_google_recaptcha_in_widget_3" %1$s> <label for="disable_google_recaptcha_in_widget_3">%2$s</label>',
			( isset( $this->register_widget_settings_options['disable_google_recaptcha_in_widget_3'] ) && $this->register_widget_settings_options['disable_google_recaptcha_in_widget_3'] === 'disable_google_recaptcha_in_widget_3' ) ? 'checked' : '',
			__('Enable ReCaptcha in widget and on default wp-login.php forms','loginregisterwidget')
		);
	}
	
	public function disable_google_recaptcha_in_widget_3_callback_dark() {
		printf(
			'<input type="checkbox" name="register_widget_settings_option_name[disable_google_recaptcha_in_widget_3_dark]" id="disable_google_recaptcha_in_widget_3_dark" value="disable_google_recaptcha_in_widget_3_dark" %1$s> <label for="disable_google_recaptcha_in_widget_3_dark">%2$s</label>',
			( isset( $this->register_widget_settings_options['disable_google_recaptcha_in_widget_3_dark'] ) && $this->register_widget_settings_options['disable_google_recaptcha_in_widget_3_dark'] === 'disable_google_recaptcha_in_widget_3_dark' ) ? 'checked' : '',
			__('Enable Google ReCaptcha Dark Theme','loginregisterwidget')
		);
	}

}
if ( is_admin() )
	$register_widget_settings = new RegisterWidgetSettings();