<?php
/*
Plugin Name: Translator
Plugin URI: http://www.conveythis.com/
Description: Translate your blog into over 100 languages. With just one click, ConveyThis Translator uses the power of Google Translate to provide easy and instant translation for your blog.
Version: 3.1.2
Author: ConveyThis Translator
Author URI: http://www.conveythis.com/
License: GPL2
*/

/*
Copyright 2016 ConveyThis (email : info@conveythis.com)

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

class ConveyThisWidget {
	private	$button_path				= 'http://s1.conveythis.com/e4';
	private	$javascript_path			= '/javascript';
	private	$image_path					= '/images';
	private $conveythis_src				= 'en';
	private	$conveythis_id				= null; 
	private	$ct_skip_jq					= false;
	private $ct_button_id				= 1;
	private $ct_first_save				= 0;
	private $conveythis_trial_key		= null;
	private $conveythis_trial_expires	= null;
	private $conveythis_languages = array(
		'af' => 'Afrikaans', 
		'sq' => 'Albanian', 
		'am' => 'Amharic', 
		'ar' => 'Arabic', 
		'hy' => 'Armenian', 
		'az' => 'Azerbaijani', 
		'eu' => 'Basque', 
		'be' => 'Belarusian', 
		'bn' => 'Bengali', 
		'bs' => 'Bosnian', 
		'bg' => 'Bulgarian', 
		'ca' => 'Catalan', 
		'ceb' => 'Cebuano', 
		'ny' => 'Chichewa', 
		'zh-CN' => 'Chinese Simplified', 
		'zh-TW' => 'Chinese Traditional', 
		'co' => 'Corsican', 
		'hr' => 'Croatian', 
		'cs' => 'Czech', 
		'da' => 'Danish', 
		'nl' => 'Dutch', 
		'en' => 'English', 
		'eo' => 'Esperanto', 
		'et' => 'Estonian', 
		'tl' => 'Filipino', 
		'fi' => 'Finnish', 
		'fr' => 'French', 
		'fy' => 'Frisian', 
		'gl' => 'Galician', 
		'ka' => 'Georgian', 
		'de' => 'German', 
		'el' => 'Greek', 
		'gu' => 'Gujarati', 
		'ht' => 'Haitian Creole', 
		'ha' => 'Hausa', 
		'haw' => 'Hawaiian', 
		'iw' => 'Hebrew', 
		'hi' => 'Hindi', 
		'hmn' => 'Hmong', 
		'hu' => 'Hungarian', 
		'is' => 'Icelandic', 
		'ig' => 'Igbo', 
		'id' => 'Indonesian', 
		'ga' => 'Irish', 
		'it' => 'Italian', 
		'ja' => 'Japanese', 
		'jw' => 'Javanese', 
		'kn' => 'Kannada', 
		'kk' => 'Kazakh', 
		'km' => 'Khmer', 
		'ko' => 'Korean', 
		'ku' => 'Kurdish', 
		'ky' => 'Kyrgyz', 
		'lo' => 'Lao', 
		'la' => 'Latin', 
		'lv' => 'Latvian', 
		'lt' => 'Lithuanian', 
		'lb' => 'Luxembourgish', 
		'mk' => 'Macedonian', 
		'mg' => 'Malagasy', 
		'ms' => 'Malay', 
		'ml' => 'Malayalam', 
		'mt' => 'Maltese', 
		'mi' => 'Maori', 
		'mr' => 'Marathi', 
		'mn' => 'Mongolian', 
		'my' => 'Myanmar', 
		'ne' => 'Nepali', 
		'no' => 'Norwegian', 
		'ps' => 'Pashto', 
		'fa' => 'Persian', 
		'pl' => 'Polish', 
		'pt' => 'Portuguese', 
		'pa' => 'Punjabi', 
		'ro' => 'Romanian', 
		'ru' => 'Russian', 
		'sm' => 'Samoan', 
		'gd' => 'Scots Gaelic', 
		'sr' => 'Serbian', 
		'st' => 'Sesotho', 
		'sn' => 'Shona', 
		'sd' => 'Sindhi', 
		'si' => 'Sinhala', 
		'sk' => 'Slovak', 
		'sl' => 'Slovenian', 
		'so' => 'Somali', 
		'es' => 'Spanish', 
		'su' => 'Sundanese', 
		'sw' => 'Swahili', 
		'sv' => 'Swedish', 
		'tg' => 'Tajik', 
		'ta' => 'Tamil', 
		'te' => 'Telugu', 
		'th' => 'Thai', 
		'tr' => 'Turkish', 
		'uk' => 'Ukrainian', 
		'ur' => 'Urdu', 
		'uz' => 'Uzbek', 
		'vi' => 'Vietnamese', 
		'cy' => 'Welsh', 
		'xh' => 'Xhosa', 
		'yi' => 'Yiddish', 
		'yo' => 'Yoruba', 
		'zu' => 'Zulu', 
	);
	private $link_titles = array('professional translation');
	private $link_urls = array('http://translation-services-usa.com');
	private $buttons = array(
		1 => array(
			'image_name' => 'translate1.gif', 
			'class_name' => 'translate1', 
			'additional_classes' => 'conveythis-drop', 
		), 
		2 => array(
			'image_name' => 'convey1.gif', 
			'class_name' => 'convey1', 
			'additional_classes' => 'conveythis-drop', 
		), 
		3 => array(
			'image_name' => 'translate2.gif', 
			'class_name' => 'translate2', 
			'additional_classes' => 'conveythis-drop', 
		), 
		4 => array(
			'image_name' => 'notext.gif', 
			'class_name' => 'notext', 
			'additional_classes' => 'conveythis-drop', 
		), 
		5 => array(
			'image_name' => 'translate3.gif', 
			'class_name' => 'translate3', 
			'additional_classes' => '', 
		), 
		6 => array(
			'image_name' => 'translate4.gif', 
			'class_name' => 'translate4', 
			'additional_classes' => 'conveythis-drop', 
		), 
		7 => array(
			'image_name' => 'convey2.gif', 
			'class_name' => 'convey2', 
			'additional_classes' => 'conveythis-drop', 
		), 
		8 => array(
			'image_name' => 'translate5.gif', 
			'class_name' => 'translate5', 
			'additional_classes' => 'conveythis-drop', 
		), 
		9 => array(
			'image_name' => 'notext2.gif', 
			'class_name' => 'notext2', 
			'additional_classes' => 'conveythis-drop', 
		), 
		10 => array(
			'image_name' => 'translate6.gif', 
			'class_name' => 'translate6', 
			'additional_classes' => '', 
		), 
	);
	
	// Constructor.
	function ConveyThisWidget() {
		// Add the full paths.
		$this->javascript_path	= $this->button_path . $this->javascript_path;
		$this->image_path		= $this->button_path . $this->image_path;
		// Add functions to the content and excerpt.
		add_filter('the_content', array(&$this, 'codeToContent'));
		add_filter('get_the_excerpt', array(&$this, 'conveyThisExcerptTrim'));
		add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'pluginSettingsLink'));
		// Initialize the plugin.
		add_action('admin_menu', array(&$this, '_init'));
		// Display the admin notification
		add_action('admin_notices', array($this, 'plugin_activation'));
		// Get the plugin options.
		if (get_option('conveythis_src')) {
			$this->conveythis_src = get_option('conveythis_src');
		}
		if (get_option('conveythis_id')) {
			$this->conveythis_id = get_option('conveythis_id');
		}
		if (get_option('ct_skip_jq')) {
			$this->ct_skip_jq = get_option('ct_skip_jq');
		}
		if (get_option('ct_button_id')) {
			$this->ct_button_id = get_option('ct_button_id');
		}
		if (get_option('ct_first_save')) {
			$this->ct_first_save = get_option('ct_first_save');
		}
		if (get_option('conveythis_trial_key')) {
			$this->conveythis_trial_key = get_option('conveythis_trial_key');
		}
		if (get_option('conveythis_trial_expires')) {
			$this->conveythis_trial_expires = get_option('conveythis_trial_expires');
		}
		// Determine which "conveythis_id" value to use (free trial/registered).
		$conveythis_id_value = !empty($this->conveythis_id) ? (string)$this->conveythis_id : (string)$this->conveythis_trial_key;
		// Parameterize variables for script URL.
		$script_name = sprintf(
			'/e.js?conveythis_src=%s&conveythis_id=%s&skip_jq=%d', 
			(string)$this->conveythis_src, 
			$conveythis_id_value, 
			(int)$this->ct_skip_jq
		);
		// Register our scripts.
		wp_register_script('ct_conveythis', $this->javascript_path . $script_name, 'jquery', '4.0.1', true);
		wp_register_script('ct_admin_trial_ajax', plugins_url('conveythis-language-translation-plugin') . '/admin-trial-ajax.js', 'jquery', '1.0.0', true);
	}
	
	function _init() {
		// Add the options page.
		add_options_page('Translator Settings', 'Translator', 'manage_options', 'conveythis', array(&$this, 'pluginOptions'));
		add_submenu_page(null, 'Reset Translator Settings', 'Reset Translator', 'manage_options', 'conveythis_reset', array(&$this, 'pluginReset'));
		// Register our plugin settings.
		register_setting('ct_options', 'conveythis_src', array(&$this, 'validateLanguage'));
		register_setting('ct_options', 'conveythis_id');
		register_setting('ct_options', 'ct_skip_jq');
		register_setting('ct_options', 'ct_button_id');
		register_setting('ct_options', 'ct_first_save');
		register_setting('ct_options', 'conveythis_trial_key');
		register_setting('ct_options', 'conveythis_trial_expires');
	}
	
	function plugin_activation() {
		if (current_user_can('manage_options') && !$this->ct_first_save) {
			echo <<<EOL
				<div class="error settings-error notice">
					<p><strong>Warning! Your Translator button is not set up yet!</strong></p>
					<p>Be sure to select your site's language and other options under <a href="options-general.php?page=conveythis">Translator Settings</a>!</p>
				</div>
EOL;
		}
	} 
	
	// Called whenever content is shown.
	function codeToContent($content) {
		// What we add depends on type.
		if (is_feed()) {
			// Add nothing to RSS feed.
			return $content;
		} else if (is_category()) {
			// Add nothing to categories.
			return $content;
		} else if (is_singular()) {
			// For singular pages we add the button to the content normally.
			wp_enqueue_script('jquery');
			wp_enqueue_script('ct_conveythis');
			return $this->getConveyThisCode() . $content;
		} else {
            // For everything else add nothing.
            return $content;
        }
	}
	
	// Get the actual button code.
	function getConveyThisCode() {
		// Get the proper link
		$use_link			= rand(0, (count($this->link_titles) - 1));
		$link_title			= $this->link_titles[$use_link];
		$link_url			= $this->link_urls[$use_link];
		$class_name			= $this->buttons[$this->ct_button_id]['class_name'];
		$additional_classes	= $this->buttons[$this->ct_button_id]['additional_classes'];
		$conveythis_code = <<<EOL
			<!-- Translator button: -->
			<span class="conveythis" translate="no"><a href="$link_url" title="$link_title" class="conveythis-image $additional_classes $class_name">$link_title</a></span>
			<!-- End Translator button code. -->
EOL;
		return $conveythis_code;
	}
	
	// Reset plugin options.
	function pluginReset() {
		if (!current_user_can('manage_options'))  {
			wp_die('You do not have sufficient permissions to access this page.');
		}
		?>
		<div class="wrap">
			<form method="post" action="options.php">
				<?php settings_fields('ct_options'); ?>
				<input name="ct_skip_jq" type="hidden" value="0" />
				<input name="ct_button_id" type="hidden" value="1" />
				<input name="conveythis_src" type="hidden" value="en" />
				<input name="conveythis_id" type="hidden" value="" />
				<input name="free_trial" type="hidden" value="0" />
				<input name="conveythis_trial_key" type="hidden" value="" />
				<input name="conveythis_trial_url" type="hidden" value="" />
				<input name="conveythis_trial_expires" type="hidden" value="" />
				<input name="ct_first_save" type="hidden" value="0" />
				<h2>Reset Translator Options</h2>
				<p>Click the &quot;Reset Settings&quot; button below to reset the plugin's options to their default settings:</p>
				<table class="widefat">
					<thead>
						<tr>
							<th width="33.333%">Option</th>
							<th width="66.666%">Default Setting</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><b>jQuery version checking</b></td>
							<td>enabled</td>
						</tr>
						<tr>
							<td><b>Button style</b></td>
							<td><img src="<?php echo $this->image_path;?>/buttons/translate1.gif" alt="" style="vertical-align:middle;" /></td>
						</tr>
						<tr>
							<td><b>Source language</b></td>
							<td>English</td>
						</tr>
						<tr>
							<td><b>Registered ConveyThis account</b></td>
							<td>none</td>
						</tr>
						<tr>
							<td><b>Free trial settings</b></td>
							<td>unset</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Reset Settings to Default" class="button-primary" /> 
								<a href="options-general.php?page=conveythis" class="button">Cancel</a>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<?php
	}
	
	// Admin page display.
	function pluginOptions() {
		if (!current_user_can('manage_options'))  {
			wp_die('You do not have sufficient permissions to access this page.');
		}
		// Enqueue scripts.
		wp_enqueue_script('jquery');
		wp_enqueue_script('ct_admin_trial_ajax');
		?>
		<div class="wrap">
			<form id="conveythis-settings" method="post" action="options.php">
				<?php settings_fields('ct_options'); ?>
				<input name="ct_skip_jq" type="hidden" value="0" />
				<input name="ct_button_id" type="hidden" value="1" />
				<input name="conveythis_src" type="hidden" value="en" />
				<input name="conveythis_id" type="hidden" value="" />
				<input name="free_trial" type="hidden" value="0" />
				<input name="conveythis_trial_key" type="hidden" value="" />
				<input name="conveythis_trial_url" type="hidden" value="" />
				<input name="conveythis_trial_expires" type="hidden" value="" class="conveythis_trial_expires" />
				<input name="ct_first_save" type="hidden" value="1" />
				<h2>Translator Settings</h2>
				<p>Update the language and other settings for the Translator plugin.</p>
				<table class="widefat">
					<tbody>
						<tr>
							<td colspan="2"><input type="submit" value="Save Settings" class="button-primary" /></td>
						</tr>
						<tr>
							<td colspan="2" style="padding:10px;font-family:Verdana, Geneva, sans-serif;color:#666;border-bottom:1px dotted #ddd;">
								<p><label for="conveythis_src">Your Site's Current Language</label></p>
								<p>
									<select id="conveythis_src" name="conveythis_src">
										<?php
										$current_src = get_option('conveythis_src') ? get_option('conveythis_src') : $this->conveythis_src;
										asort($this->conveythis_languages);
										foreach ($this->conveythis_languages as $key => &$value) {
											$selected = $current_src == $key ? 'selected="selected"' : '';
											printf('<option %s value="%s">%s</option>', $selected, $key, $value);
										}
										unset($value);
										?>
									</select>
								<p>
								<p>Set this to whatever language your blog is written in. If your blog is in English, and you want visitors to be able to view it in Spanish, Russian, and Japanese, select &quot;English.&quot;</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:10px;font-family:Verdana, Geneva, sans-serif;color:#666;border-bottom:1px dotted #ddd;">
								<p><label for="button_id_1">Choose a Button Style</label></p>
								<?php
								// Divid the buttons into two columns.
								$column_rows	= round(count($this->buttons));
								$first_column	= array_slice($this->buttons, 0, $column_rows / 2, true);
								$second_column	= array_slice($this->buttons, $column_rows / 2, null, true);
								?>
								<table>
									<tfoot>
										<tr>
											<td colspan="2">* no dropdown menu when moused over.</td>
										</tr>
									</tfoot>
									<tbody>
										<tr>
											<td width="50%">
												<?php
												foreach ($first_column as $id => &$button) {
													?>
													<p><label for="button_id_<?php echo $id; ?>"><input id="button_id_<?php echo $id; ?>" <?php echo ($this->ct_button_id == $id) ? 'checked="checked"' : ''; ?> name="ct_button_id" type="radio" value="<?php echo $id; ?>" /> <img src="<?php echo $this->image_path;?>/buttons/<?php echo $this->buttons[$id]['image_name']; ?>" alt="" style="vertical-align:middle;" /></label> <?php echo empty($this->buttons[$id]['additional_classes']) ? '*' : ''; ?></p>
													<?php
												}
												unset($button);
												?>
											</td>
											<td width="50%">
												<?php
												foreach ($second_column as $id => &$button) {
													?>
													<p><label for="button_id_<?php echo $id; ?>"><input id="button_id_<?php echo $id; ?>" <?php echo ($this->ct_button_id == $id) ? 'checked="checked"' : ''; ?> name="ct_button_id" type="radio" value="<?php echo $id; ?>" /> <img src="<?php echo $this->image_path;?>/buttons/<?php echo $this->buttons[$id]['image_name']; ?>" alt="" style="vertical-align:middle;" /></label> <?php echo empty($this->buttons[$id]['additional_classes']) ? '*' : ''; ?></p>
													<?php
												}
												unset($button);
												?>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:10px;font-family:Verdana, Geneva, sans-serif;color:#666;border-bottom:1px dotted #ddd;">
								<p><label for="ct_skip_jq"><input id="ct_skip_jq" <?php echo $this->ct_skip_jq ? 'checked="checked"' : ''; ?> name="ct_skip_jq" type="checkbox" value="1" /> Disable jQuery version checking</p>
								<p>Use this only if you are having trouble getting the Translator button to work. This will force-skip jQuery detection by the plugin.</p>
							</td>
						</tr>
						<tr>
							<td <?php echo empty($this->conveythis_id) ? 'width="50%"' : 'colspan="2"'; ?> style="padding:10px;font-family:Verdana, Geneva, sans-serif;color:#666;border-bottom:1px dotted #ddd;">
								<p><label for="conveythis_id">Registered ConveyThis Account Username</label> <input id="conveythis_id" name="conveythis_id" type="text" value="<?php echo htmlspecialchars($this->conveythis_id); ?>" /></p>
								<p>If you have a <a href="http://www.conveythis.com/" target="_blank">registered ConveyThis account</a>, enter your username here to activate your account benefits for your WordPress blog (<b>note:</b> be sure to add your blog URL, &quot;<?php echo bloginfo('url'); ?>&quot; to the approved domains list in your account settings).</p>
								<p>Registered users with a Google Translate API Key can translate their blog text directly on-page without redirecting through a separate frame. Read more at the <a href="http://www.conveythis.com/help.php#8" target="_blank">ConveyThis help</a> page.</p>
							</td>
							<?php
							if (empty($this->conveythis_id)) {
								?>
								<td width="50%" style="padding:10px;font-family:Verdana, Geneva, sans-serif;color:#666;border-bottom:1px dotted #ddd;">
									<?php
									if (empty($this->conveythis_trial_key)) {
										?>
										<p><label for="free_trial"><input id="free_trial" <?php echo (!$this->ct_first_save && empty($this->conveythis_trial_key)) ? 'checked="checked"' : ''; ?> name="free_trial" type="checkbox" value="1" /> Try API-powered translation free!</label></p>
										<p>Want to get a feel for how your blog will be translated with a registered ConveyThis account and Google Translate API Key? Just press the checkbox here to start your free trial!</p>
										<?php
									} else {
										?>
										<p>Your free trial information is below. Convinced? <a href="http://www.conveythis.com/" target="_blank">Register on ConveyThis.com!</a></p>
										<?php
									}
									?>
									<p><label for="conveythis_trial_url" style="display:inline-block; min-width:24%">Registered to</label> <input id="conveythis_trial_url" name="conveythis_trial_url" readonly type="text" value="<?php echo bloginfo('url'); ?>" style="min-width:74%;" /></p>
									<p><label for="conveythis_trial_key" style="display:inline-block; min-width:24%">Trial key</label> <input id="conveythis_trial_key" name="conveythis_trial_key" readonly type="text" value="<?php echo $this->conveythis_trial_key; ?>" style="min-width:74%;" /></p>
									<p><label for="conveythis_trial_expires" style="display:inline-block; min-width:24%">Expiration date</label> <input id="conveythis_trial_expires" name="conveythis_trial_expires" readonly type="text" value="<?php echo !empty($this->conveythis_trial_expires) ? date('Y-m-d g:i A T', strtotime($this->conveythis_trial_expires)) : ''; ?>" style="min-width:50%;" class="conveythis_trial_expires" /></p>
								</td>
								<?php
							}
							?>
						</tr>
						<tr>
							<td colspan="2" style="padding:10px;font-family:Verdana, Geneva, sans-serif;color:#666;">
								<b>Note:</b> if you are using any caching plugins, such as WP Super Cache, you will need to clear your cached pages after updating your Translator settings.
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" value="Save Settings" class="button-primary" /> 
								<a href="options-general.php?page=conveythis_reset" class="button">Reset to Default Options</a>
							</td>
						</tr>
					</tbody>
				</table>
				<p><b>Translator</b> is a project by <a href="http://www.conveythis.com/" target="_blank">ConveyThis</a>. Get a free quote for your professional or personal translation project at Translation Cloud now!</p>
			</form>
		</div>
		<?php
	}
	
	// Add settings link on plugin page
	function pluginSettingsLink($links) { 
		$settings_link = '<a href="options-general.php?page=conveythis">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
	
	// Remove (what's left of) our button code from excerpts.
	function conveyThisExcerptTrim($text) {
		/*
		$pattern		= '/Translatorvar conveythis_src = "(.*?)";/i';
		$replacement	= '';
		return preg_replace($pattern, $replacement, $text);
		*/
		return $text;
	}
	
	// Sanitize plugin settings options.
	function validateLanguage($language = null) {
		$return = $this->conveythis_src;
		if (array_key_exists($language, $this->conveythis_languages)) {
			$return = $language;
		}
		return $return;
	}
}

$conveythis &= new ConveyThisWidget();
?>