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
define( 'DB_NAME', 'karofi_ngocanh' );//gtscom12_karofi_ngocanh

/** MySQL database username */
define( 'DB_USER', 'root' );//Karofivietnam

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
define( 'AUTH_KEY',         'IZ#2)&V.+;PsYg8:= e/}VJv;nWAxf`k^?`>a2?6 *?wzl(CSvVN cz =ksyQcRv' );
define( 'SECURE_AUTH_KEY',  'va3Aahx-Ns[EEH{/*p$R #eH:tD5Tor0,s`b1y]J?=Rm+{ P{Oq<E1& Z?blI7Mj' );
define( 'LOGGED_IN_KEY',    '0F*I%bptK-z7![<Dq-$WyS^gh0Mhxo/pc[fnZ$o`UI_]dq_FnGVUF-t8;ly`Qk04' );
define( 'NONCE_KEY',        'U*|KQEfzh(dE8*6l/MV6#*V:6JCE0ZphGkq;E$hGG0Doke,C<Jlr=VuT8dhgEpLH' );
define( 'AUTH_SALT',        'tEo7sI<NwH_ODbm-o7~(h:_eEPl|pHm;lFaJtE`AtcSc)Y+z3~ZS@+ruSgFAdQ.9' );
define( 'SECURE_AUTH_SALT', 'F%yikn,CNmkmv0WjUcxk|YQA+6z4JZBv02tnJD+luxD[5x]x7<J^|OK= Bu!J0(J' );
define( 'LOGGED_IN_SALT',   'yPuWa+%T:ez5,d0pMM1^-~PER`J%Du1DR*r.[rH2*wll5r2IiWq(eF!P)9zqMipV' );
define( 'NONCE_SALT',       ']+WDK5EK3AH.c*cx3+N&ER~ZGiMEA8+$u$-;xl_*2%T?j2%gOHA7BuY!C>@W?((H' );

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
