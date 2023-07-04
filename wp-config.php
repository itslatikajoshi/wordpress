<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/xFpDE<VI+/nMfX%d4c$ok3hYI@(RvRZ!_$sEZ~Z(h-C~1T4tOF-.>R,A>`@Rj R' );
define( 'SECURE_AUTH_KEY',  'c?Ay`2x?R(k~@eX}Vr5@SfdUZ4yb@.fl/Ez8Z+_|[4aU<6PB6^[uV5hQR&i;XMQA' );
define( 'LOGGED_IN_KEY',    'x`b#Q!tc/CzrZ6[BBU&,|2z0q:89#zJ+X5j-0:J04tD8^T@5*GgptB4/{EaRtJj_' );
define( 'NONCE_KEY',        '!IR]F&bGR:|8Kd?:,M}5/*;4hw yNkO;;mF5-~ea0^e$r%LhX_6z0P1J>^~;7B~}' );
define( 'AUTH_SALT',        ',FF>d!lwD43];GFC$bV%X/#;8- VL]dBXE9jqCX]uF!}Nr<Xn>~[cC~3lT@^ s*c' );
define( 'SECURE_AUTH_SALT', ')/Z^.:,7oT|elq~gsAD^s]3H6PWIw|1_s;Q(OBtrwNbUh$#+p$QVVLqsM3N{4zYg' );
define( 'LOGGED_IN_SALT',   'YSPQG`Mjsjc=6,9h_0S.J4n/SBTi)kurgJg`B4T7?: m8HgsxY.5DrQHEB}]pr@U' );
define( 'NONCE_SALT',       'K~ww9bJS=P&@wJM+G1TZsDfUm@854pT5J5w4Zyjr|0:=T:6-wNV6$0_x>bbSAMBU' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
