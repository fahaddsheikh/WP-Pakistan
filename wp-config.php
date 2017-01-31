<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'local_bepakistan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cyY{vznEedTlnHc[x6uJVI3Z0XP=*k/-v}|`ooce^&^.?P:XX]jSh[dn87fxtawv');
define('SECURE_AUTH_KEY',  '}ZNtdhsaI9|`d#,hy2`t,%m@)lvV nqVlFcf] vkD8XA!TstH@e#>TWp*r2Pi6 2');
define('LOGGED_IN_KEY',    'ubQ7{V.v$J`RReF_ua8(F,~Z3iXy.>j^J=&T+~mqpkuva>T])a)de.!Bj>`;NjnV');
define('NONCE_KEY',        'sMGqB3Y<(!)l|H~)o1tQ+s!?iNU6}tQo@aYlei_.2Qq M=!^egT2@,pA~/<WYkpL');
define('AUTH_SALT',        '>q@V+7FtP_6x`Y[CG`|K07=B+:=m;w8@UN-KCG`4*]fV>`1VNHDmCVllaY^/_V0/');
define('SECURE_AUTH_SALT', '=1f_A^VU!^UYRG,<,yc50#/%&1pf_j>2v$x7>_g}4h|tE!jF}TgJ9jyp(*$N67=8');
define('LOGGED_IN_SALT',   'P~%P`R#1%Wu0um,x|@v={xj#{OcVR+B.$@>hCtN8u0ac1+#B[)uR*Q[*nOXxs91K');
define('NONCE_SALT',       'uJx6n%[OmcTQ&MGF->`I=yQ53v+:};*q^.=1%UvQy;/2B~b!;ih1^[ApShF}hfJ~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
