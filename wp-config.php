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
define('DB_NAME', 'dxtwicgp_db');

/** MySQL database username */
//define('DB_USER', 'dxtwicgp_db');
define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', '274cTTG(a!oT');
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
define('AUTH_KEY',         'x`?9#y`+NV$F[v|vk4!|TK|DFp1Y$G&KKcY&o6C2J38I5F-7t9K!2d,/ bSfg7T7');
define('SECURE_AUTH_KEY',  '_+!m3,lDXm:?Sh*g28a8eWG7+m-Lj|iE6b?NV>d72S=B>ar  ctAKLEB|g9]&7F!');
define('LOGGED_IN_KEY',    'n-T?lf@COxv~C T^_&>,uicd-(W!$aNm+;Lu]BrqAi/.ZBpCZ(H=EAz74%xCeFp!');
define('NONCE_KEY',        'ez;OMVHj{/f<I>&wWK%(l8ytg*^be-kX?ARgeqw,jj:?*yZ-;0m&u#hfa0-GMD#R');
define('AUTH_SALT',        'n*0e$YA[hH<Vo4PG|/%T:4_>y,D]7cqTQz:4L(x~]^c_m/L]{g#<}o4HaMlL#5#R');
define('SECURE_AUTH_SALT', 'xjf}C :,7~2 ta]f8UovsOo_-cK<:@5L[aP/vF>ox}iz%CV)h6yV&ie8%~v<^)U3');
define('LOGGED_IN_SALT',   'I^V+.nYP%`@]1`0HBE  n!xp@Cpq]q^K{$l<#ryZ+,GK*5Df^log?#2|&]lUh$jx');
define('NONCE_SALT',       'f)4@uCE)u%0of1D2uP!!/8<E!ohfSU<c]@9<!ou)#L.U;OlE[q4L0c|4%1!UChxO');

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
