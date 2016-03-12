<?php

class loginregisterwidget extends WP_Widget {

// constructor
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'loginregisterwidget', 

		// Widget name will appear in UI
		__('Register, Login Widget', 'loginregisterwidget'), 

		// Widget description
		array( 'description' => __( 'Display a register form, login form and forgot password form.', 'loginregisterwidget' ), ) 
		);
	}
	
	public function flush_widget_cache() {
		wp_cache_delete('loginregisterwidget', 'widget');
	}
	
	public function widget( $args, $instance ) {
		
		
		ob_start();

		
		$show_login = isset( $instance['show_login'] ) ? $instance['show_login'] : false;

		$show_lost = isset( $instance['show_lost'] ) ? $instance['show_lost'] : false;
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Account','loginregisterwidget');
		$custom_image_path = trailingslashit(get_stylesheet_directory()).'ajax-loader.gif';
		if(file_exists($custom_image_path)){
			$image_url = trailingslashit(get_stylesheet_directory_uri()).'ajax-loader.gif';
		}else {
			$image_url = plugin_dir_url(__FILE__).'ajax-loader.gif';
		}
		if(!is_user_logged_in()){
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
		} ?>
		<div class="register-widget-container">
		<?php if ($show_login || $show_lost){?>
			<ul>
				<?php if($show_login){ ?>
				<li class="register-widget-inline register-widget-login"><a class="register-widget-tab" href="#register-widget-login"><?php _e('Log in','loginregisterwidget'); ?></a></li>
				<?php }?>
				<li class="register-widget-inline register-widget-register"><a class="register-widget-tab" href="#register-widget-register"><?php _e('Register','loginregisterwidget'); ?></a></li>
				<?php if($show_lost){ ?>
				<li class="register-widget-inline register-widget-lostpassw"><a class="register-widget-tab" href="#register-widget-lost"><?php _e('Lost password','loginregisterwidget'); ?></a></li>
				<?php }?>
			</ul>
		<?php }?>
			<?php if($show_login){ ?>
			<div id="register-widget-login">
				<div class="register-widget-title-login">
					<h1><?php _e('Log in','loginregisterwidget'); ?></h1>
				</div>
				<form name="loginform" id="loginform" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')) ?>" method="post">
					<label for="user_login"><?php _e('Username','loginregisterwidget'); ?></label>
						<input type="text" required name="log" id="user_login" class="input" value="" size="20">
					<label for="user_pass"><?php _e('Password','loginregisterwidget'); ?></label>
						<input type="password" required name="pwd" id="user_pass" class="input" value="" size="20">
					<p class="login-remember">
					<br>
						<label>
							<input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php _e('Remember Me','loginregisterwidget'); ?>
						</label>
					</p>
					<?php do_action('loginregisterwidget_login_form'); ?>
					<div id="error-login-widget"></div>
					<p>
						<img id="ajaxicon-login-widget" src="<?php echo esc_url($image_url)?>" alt="Loading icon"></img>
					</p>
					<p class="login-submit">
						<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In">
					</p>
				</form>
			</div>
			<?php }?>
			<div id="register-widget-register">
				<div class="register-widget-title">
					<h1><?php _e('Register your account','loginregisterwidget'); ?></h1>
				</div>
				<form id="custom-register-widget" action="<?php echo esc_url(site_url('wp-login.php?action=register', 'login_post')) ?>" method="post">
					<label for="user_login"><?php _e('Username','loginregisterwidget'); ?><br>
						<input type="text" name="user_login" id="user_login" required class="input" size="20">
					</label>
					<br>
					<label for="user_email"><?php _e('E-mail','loginregisterwidget'); ?><br>
						<input type="email" name="user_email" id="user_email" required class="input" size="25">
					</label>
					<?php do_action('loginregisterwidget_register_form'); ?>
					<p class="password-emailed"><?php _e('A password will be e-mailed to you.','loginregisterwidget'); ?></p>
					<div id="error-register-widget"></div>
					<div class="registration-complete" id="success-register-widget">
						<span><?php _e('Registration complete. Please check your e-mail.','loginregisterwidget'); ?></span>
					</div>
					<p>
						<img id="ajaxicon-register-widget" src="<?php echo esc_url($image_url)?>" alt="Loading icon"></img>
					</p>
					<p class="register-submit">
						<input type="submit" name="wp-submit" id="wp-submit" value="Register">
					</p>
				</form>
			</div>
			<?php if($show_lost){ ?>
			<div id="register-widget-lost">
				<div class="register-widget-title-lost">
					<h1><?php _e('Lost password','loginregisterwidget'); ?></h1>	
				</div>
				<form name="lostpasswordform" id="lostpasswordform" action="<?php echo esc_url(site_url('wp-login.php?action=lostpassword', 'login_post')) ?>" method="post">
					<p class="lost-password-text">
						<?php _e('Please enter your username or email address. You will receive a link to create a new password via email.','loginregisterwidget'); ?>
					</p>
					<p>
						<label for="user_login"><?php _e('Username or Email:','loginregisterwidget'); ?><br>
						<input type="text" required name="user_login" id="user_login" class="input" value="" size="20"></label>
					</p>
					<?php do_action('loginregisterwidget_lostpassword_form'); ?>
					<div id="error-lost-widget"></div>
					<div class="lost-complete" id="success-lost-widget">
						<span><?php _e('Check your e-mail for the confirmation link.','loginregisterwidget'); ?></span>
					</div>
					<p>
						<img id="ajaxicon-lost-widget" src="<?php echo esc_url($image_url)?>" alt="Loading icon"></img>
					</p>
					<p class="lost-password-submit">
						<input type="submit" name="wp-submit" id="wp-submit" value="Get New Password">
					</p>
				</form>
			</div>
			<?php } ?>
		</div>	
		<?php echo $args['after_widget']; ?>
<?php
		} //end is user logged in
		ob_end_flush();
	}
	
	public function form( $instance ) {
		$domain = 'loginregisterwidget';
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$show_login = isset( $instance['show_login'] ) ? (bool) $instance['show_login'] : false;
		$show_lost = isset( $instance['show_lost'] ) ? (bool) $instance['show_lost'] : false;
		?>
				<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:',$domain ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
				<p><input class="checkbox" type="checkbox" <?php checked( $show_login ); ?> id="<?php echo $this->get_field_id( 'show_login' ); ?>" name="<?php echo $this->get_field_name( 'show_login' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_login' ); ?>"><?php _e( 'Show login feature?',$domain ); ?></label></p>
				<p><input class="checkbox" type="checkbox" <?php checked( $show_lost ); ?> id="<?php echo $this->get_field_id( 'show_lost' ); ?>" name="<?php echo $this->get_field_name( 'show_lost' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_lost' ); ?>"><?php _e( 'Show lost password feature?',$domain ); ?></label></p>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_login'] = isset( $new_instance['show_login'] ) ? (bool) $new_instance['show_login'] : false;
		$instance['show_lost'] = isset( $new_instance['show_lost'] ) ? (bool) $new_instance['show_lost'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['loginregisterwidget']) )
			delete_option('loginregisterwidget');

		return $instance;
	}
}

	// Register and load the widget
	function loginregisterwidget_load_widget() {
		register_widget( 'loginregisterwidget' );
	}
	add_action( 'widgets_init', 'loginregisterwidget_load_widget' );

?>