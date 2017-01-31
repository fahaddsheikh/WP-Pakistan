<?php
/**
 * Plugin Name: AIT Events Pro
 * Version: 1.16
 * Description: Adds new custom post type Events Pro
 *
 * Author: AitThemes.Club
 * Author URI: https://ait-themes.club
 * License: GPLv2 or later
 * Text Domain: ait-events-pro
 * Domain Path: /languages/
 */


/* trunk@r238 */

define('AIT_EVENTS_PRO_VERSION', '1.16');

define('AIT_EVENTS_PRO_ENABLED', true);

require_once dirname(__FILE__) . '/includes/AitEventsPro.php';

AitEventsPro::getInstance()->run(__FILE__);
