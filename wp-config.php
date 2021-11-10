<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'karofi_ngocanh');//gtscom12_karofiNgocanh/local: karofi_ngocanh

/** MySQL database username */
define( 'DB_USER', 'root');//gtscom12_karofiNgocanh// tkadmin: Karofivietnam//pas:Karofivietnam@20216868

/** MySQL database password */
define( 'DB_PASSWORD', '' );//Karofivietnam@20216868

/** MySQL hostname */
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
define('AUTH_KEY',         '0-e++6:*vy)x.|E]V9MpPz@#h]jGr?.Ly-OE iRm6*H-PZ7])&,LxzrAMd_r8<HJ');
define('SECURE_AUTH_KEY',  '34PdfGIpofqafrdso->f2Ow|ONbJLR$(H^<Q7QfLlEKk.blZF|elN[5Dl-%zW?8{');
define('LOGGED_IN_KEY',    '1Is%oMR0!|UTEoD}c>q/B4zD7=ySW)}B(Y^jXuQv2yAXU;/J2-H-djrVW^i-UWu)');
define('NONCE_KEY',        '`FRElx_YE8$*KN7roki~%#3st[g,_6o%x+H$_EAW+1p.,|j^>E+l8rvyR_!#O%ez');
define('AUTH_SALT',        '^HpdxLii+(=AnV?7}>36ze.W#KpL=W*vU1/xmt|b8]h5,[&|n ln}?_<5ktd,whS');
define('SECURE_AUTH_SALT', '0}|h[/,`.Gy*zMF@BVFrE A]e0%R0|At4Uw{7pe|18yj>+:y.T>L$7~duBStX%KF');
define('LOGGED_IN_SALT',   ';74ecN|tgp6stk?zYeV`dK_-ba4mOXm6Qo:&*y&Qk!3eY~3)+3_4.pr?IEV,AC@J');
define('NONCE_SALT',       'U1_Pg%Pvs9&FzC9++FC]|}7oqy:)@E|:tAj,|^&Mvp)*}nubwUF@g-y{Uw9$[fCt');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'karonanh_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
$memcached_servers = array( 'default' => array(
	'/home/gtscom12/.applicationmanager/memcached.sock:0')
	);
