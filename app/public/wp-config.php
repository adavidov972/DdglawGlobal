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

//When using local copy

if (file_exists(dirname(__FILE__) . '/local.php')) {
		define( 'DB_NAME', 'local' );
		define( 'DB_USER', 'root' );
		define( 'DB_PASSWORD', 'root' );
		define( 'DB_HOST', 'localhost' );
}
//When using live copy
else {
		define( 'DB_NAME', 'lawgrmwz_up' );
		define( 'DB_USER', 'lawgrmwz_up' );
		define( 'DB_PASSWORD', 'Qazxsw21' );
		// define( 'DB_HOST', 'http://s-il-771-pgy.upress.io/phpMyAdmin');
		define( 'DB_HOST', 'localhost');
}
/** The name of the database for WordPress */

define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'DB_DEBUG', true );

define( 'DB_DEBUG_LOG', true );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'PYZ8M5NG2SsWPWgn1B5aKDgrthefjyUKn+mHq5IN+4iWYDrxil6qe9NcSxx2JOGrTLioroBV1MnF0vD5Wzj5oA==');
define('SECURE_AUTH_KEY',  'fDx2Y+8Prxo3bQS7AAMPb4/WcB2Fjm5ADVe0kpHOAZii+S/Y602OrbZKxtO1JMRH2s/Xjb+G5uIBmGwHXQoH2Q==');
define('LOGGED_IN_KEY',    'Yg5xMTNl4KTPatY7jtnfIvVJjPSU3tnrck0rm8y5bZQLF14WBT/gjvwtxsmbLav8J+H84x4P2Pu7bK94WZz3Cg==');
define('NONCE_KEY',        'wj1qOSvzW+pFniIUhprp/pq7A2w0mm5R0MoeogfEa1JLW9qn8lbHz1te+/ed4dKo0hCVxhBo+vc/OhrVyCY5aQ==');
define('AUTH_SALT',        'DmPHhjfZcs5DH3/haoUKlrIdUeQoUQBnNiSBFgo3oUWznlTkSd1QtJhn/7N1BKxXTgDgpthnoIGbRI3cIPQqVA==');
define('SECURE_AUTH_SALT', 'Z1RiohW0uvGf/ZiFzdO7kEtrNm1LJ5DI3w36PynbdBxVNrzgq6mgXrDp6WHcZVkyGJjeSxh7ntw555e/Ter7TQ==');
define('LOGGED_IN_SALT',   'hHU4kF7H4uDnAYjtRtegHNxJ1Qx20qNtCpL85CdLkX1PayPh91fTYaUqoFE3nDTlyjQZ2fmDXfv+egVEaT0zXQ==');
define('NONCE_SALT',       'LzAmpUUuXEqqOVlOF//3puId93oAkwZZ32UdMeJTl/lLjajoi6ISvr6+KowyQjn09D/iyY3dBISl5qOB/sN5jw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
