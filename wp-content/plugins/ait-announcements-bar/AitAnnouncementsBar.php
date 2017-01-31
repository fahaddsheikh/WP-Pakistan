<?php



class AitAnnouncementsBar
{

	protected static $file;
	protected static $baseDir;
	protected static $baseUrl;



	public static function run($file, $baseDir, $baseUrl)
	{
		self::$file = $file;
		self::$baseDir = $baseDir;
		self::$baseUrl = $baseUrl;

		add_action('plugins_loaded', array(__CLASS__, 'onPluginsLoaded'));
	}



	public static function onPluginsLoaded()
	{
		if(is_admin()){
			add_action('admin_menu', array(__CLASS__, 'addOptionsPage'));
			add_action('admin_init', array(__CLASS__, 'settingsInit'));
			load_plugin_textdomain('ait-announcements-bar', false, basename(self::$baseDir) . '/languages');
		}

		add_action('wp_head', array(__CLASS__, 'addStyles'), 33);
		add_action('template_redirect', array(__CLASS__, 'onTemplateRedirect'));
	}



	public static function onTemplateRedirect()
	{
		add_action('ait-html-body-begin', array(__CLASS__, 'renderAnnouncementsBar'));
		add_filter('body_class', array(__CLASS__, 'bodyHtmlClass'), 10, 2);
	}



	public static function bodyHtmlClass($classes, $class)
	{
		if(!self::canBeDisplayed()) return $classes;

		$classes[] = 'ait-announcements-bar-plugin';

		return $classes;
	}



	public static function addOptionsPage()
	{
		add_options_page(
			__('Announcements Bar', 'ait-announcements-bar'),   // Name of page
			__('Announcements Bar', 'ait-announcements-bar'),   // Name of page
			'edit_theme_options',                    // Capability required
			'ait_announcements_bar_options',         // Menu slug, used to uniquely identify the page
			array(__CLASS__, 'renderOptionsPage') // Function that renders the options page
		);
	}



	public static function renderOptionsPage()
	{
	?>
	<div class="wrap">
		<?php screen_icon() ?>
		<h2><?php _e('Announcements Bar', 'ait-announcements-bar') ?></h2>

		<form method="post" action="options.php">
			<?php
				settings_fields('ait_announcements_bar_options');
				do_settings_sections('ait_announcements_bar_options');
				submit_button();
			?>
		</form>
	</div>
	<?php
	}



	public static function settingsInit()
	{
		register_setting(
			'ait_announcements_bar_options',  // Options group, see settings_fields() call in ait_theme_options_render_page()
			'ait_announcements_bar_options', // Database option, see ait_get_theme_options()
			array(__CLASS__, 'validateOptions') // The sanitization callback, see ait_theme_options_validate()
		);

		// Register our settings field group
		add_settings_section(
			'general', // Unique identifier for the settings section
			'', // Section title (we don't want one)
			'__return_false', // Section callback (we don't want anything)
			'ait_announcements_bar_options' // Menu slug, used to uniquely identify the page; see ait_theme_options_add_page()
		);

		// Register our individual settings fields
		add_settings_field('html', 'HTML', array(__CLASS__, 'renderFieldHtml'), 'ait_announcements_bar_options', 'general');
		add_settings_field('css', 'CSS', array(__CLASS__, 'renderFieldCss'), 'ait_announcements_bar_options', 'general');
		add_settings_field('start_date', __('Start Date', 'ait-announcements-bar'), array(__CLASS__, 'renderFieldStartDate'), 'ait_announcements_bar_options', 'general');
		add_settings_field('end_date', __('End Date', 'ait-announcements-bar'), array(__CLASS__, 'renderFieldEndDate'), 'ait_announcements_bar_options', 'general');
	}



	public static function validateOptions($input)
	{
		return wp_parse_args($input, self::getOptions());
	}



	public static function getDefaultOptions()
	{
		return array(
			'css'        => "#ait-announcements-bar { background-color: ivory; }\n#ait-announcements-bar p { text-align:center; }",
			'html'       => '<p>Something to announce!</p>',
			'start_date' => date('Y-m-d H:i:s', current_time('timestamp') + HOUR_IN_SECONDS),
			'end_date'   => date('Y-m-d H:i:s', current_time('timestamp') + DAY_IN_SECONDS),
		);
	}



	public static function getOptions($key = '')
	{
		// https://make.wordpress.org/themes/2014/07/09/using-sane-defaults-in-themes/
		$options = wp_parse_args(
			get_option('ait_announcements_bar_options', array()),
			self::getDefaultOptions()
		);

		if($key and isset($options[$key])){
			return $options[$key];
		}

		return $options;
	}



	public static function renderFieldCss()
	{
		?>
		<textarea name="ait_announcements_bar_options[css]" class="code" rows="10" cols="80"><?php echo esc_textarea(self::getOptions('css')) ?></textarea>
		<?php
	}



	public static function renderFieldHtml()
	{
		?>
		<textarea name="ait_announcements_bar_options[html]" class="code" rows="10" cols="80"><?php echo esc_textarea(self::getOptions('html')) ?></textarea>
		<?php
	}



	public static function renderFieldStartDate()
	{
		?>
		<input type="text" name="ait_announcements_bar_options[start_date]" value="<?php echo esc_attr(self::getOptions('start_date')) ?>">
		<?php
	}



	public static function renderFieldEndDate()
	{
		?>
		<input type="text" name="ait_announcements_bar_options[end_date]" value="<?php echo esc_attr(self::getOptions('end_date')) ?>">
		<?php
			$ts = strtotime(self::getOptions('end_date'));
			if($ts < current_time('timestamp')){
				_e('Expired. Bar is no longer displayed.', 'ait-announcements-bar');
			}
		?>
		<?php
	}



	public static function canBeDisplayed()
	{
		$start_ts = strtotime(self::getOptions('start_date'));
		$end_ts = strtotime(self::getOptions('end_date'));
		$current_ts = current_time('timestamp'); // time with timezone offset if is set in General Settings

		return ($current_ts > $start_ts and $current_ts < $end_ts);
	}



	public static function renderAnnouncementsBar()
	{
		if(!self::canBeDisplayed()) return;
		?>
		<div id="ait-announcements-bar-wrapper">
			<div id="ait-announcements-bar">
				<?php echo self::getOptions('html') ?>
			</div>
		</div>
	<?php
	}



	public static function addStyles()
	{
		if(!self::canBeDisplayed()) return;
		?><style><?php echo self::getOptions('css') ?></style><?php
	}

}