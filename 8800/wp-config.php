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
define('DB_NAME', 'dxtwicgp_8800');

/** MySQL database username */
define('DB_USER', 'dxtwicgp_8800');

/** MySQL database password */
define('DB_PASSWORD', 'ulLFNWl0#tca');

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
define('AUTH_KEY',         'u<W$$^RNd-:!v>`_:f/XgOTLQcdv{Rf<lND8.b/jQ.tle34:KZ<Qc!o(aSHp<?fu');
define('SECURE_AUTH_KEY',  '5zmr|W$qb.BR%Gra5QJiog&zk+8>ZZw=.x6tF^= D~^ze|h-skQB,{|-V=V4;nyc');
define('LOGGED_IN_KEY',    '<CDX<;D$75o5FLmGH<dWZ[easw<z$1R-W!w0Emj,FV:7Q:V+6nth,VOq/(vx!-p.');
define('NONCE_KEY',        ' [6q>`TKdmoYy!c)aM|OqgqCGTlxEX2UE=-&Oc~f>3g| Gc)jdm]jJ`[M?[wa0x-');
define('AUTH_SALT',        '_^u=vVO3}OMzP/|y-Pb1qA;U+88kc64Bzwr?NgcTWbz{Qp$XfL+F{q/^]j}xpDi9');
define('SECURE_AUTH_SALT', '8*zgOw-b6Ny~+z|6xuQ8dJSri8vMQ[  x8%{4Qvf:txhIK,(] *Mt%$Uq^FycY+K');
define('LOGGED_IN_SALT',   'mJa607|)DHoa%DU/JdKHEV!7;|=<vh1Js_$;C5z]->F&))+k$,#9Lne~Fre4O4qp');
define('NONCE_SALT',       'NfYY$c*4A^m#2NgO-xXyPNcprzGs5j{6fl-sUf;<^=0iu#}68&dZHtr]XeKw+7OA');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'adw_';

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
