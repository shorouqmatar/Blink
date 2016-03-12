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
define('DB_NAME', 'studentLibrary');

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
define('AUTH_KEY',         'D(kxyp<~a+yV7!z+=wI^]qYr$+VgxQ:kfnrx3b@PP!qp_JQG v>,*7H]hYsvZq/N');
define('SECURE_AUTH_KEY',  '()fE*=8~faypmOzG;},9%C7A2 *j`eX/s{2/z,eI|]t2KSX%lZW!s7(R{eG!k|_m');
define('LOGGED_IN_KEY',    'frr`,U)pkkf>0@(z^bW+G|KYM<CZZ @BT -S0IM-uV!U#hJMtQ6n6i$`:GW|HeBn');
define('NONCE_KEY',        '9~:fF)XqoJJ^E.gPWfAv3s|r?x{Zj-h(<.a~4 ~#K4lF28]=nLPo@ye+GN>YqP#s');
define('AUTH_SALT',        '@e(1.*AsD]2[!q@bRJFgRZ{mg7@nXHT&4?Z4fF_kEyqkv;q3AsQ=cGmSA$M((-.5');
define('SECURE_AUTH_SALT', '=HV.Z6(~<Z3/XmTI;?nda,39):1$?PcwJIsmM%{/4+qp!;N<0u^`=Wm(FToGg+ 0');
define('LOGGED_IN_SALT',   'KtY)_RTMf;MI&*3?S}J]0/;yVqeXX-0lmx!&KyMl@QVw[d?>@bBNNC@|Ek,iLOrY');
define('NONCE_SALT',       'Xhd?FlH26,U9UPl*n[l@!$p*:#VY}MWCh%8of&M`hX sP&y2v?:X`_axv:S72{@ ');

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
