<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'api_test_db' );

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
define( 'AUTH_KEY',         ',LO!0/@q_=;h/ahRW >8)T>uo/)f;(|Z>)FIo?W6;[|=tz6>5ftR?_+=~yB?h`_#' );
define( 'SECURE_AUTH_KEY',  '$?[t$Pv*R.IDz&sN3xGK1ovS(M&aO&U9xMY2D!zsp2x}FQAMI`p1wq3Gf}E<<EZL' );
define( 'LOGGED_IN_KEY',    '$7#9 AxHwZ#oKV4tA2bm<L7e]1Ri@1.84E~WpCJ2V,VXh94T<$wEV3ID[TuPSKn@' );
define( 'NONCE_KEY',        '~8qp@~).<oi[Wv.fQG~ ?(?ynfc}}6=S!K2:XR[I4a<7z54}z<8vN{e8w&uvEv?C' );
define( 'AUTH_SALT',        '^+1^mT0M<(k#q_FP3[F9X`t]Q;Oa?VXUiOAcnUP?v K?$ JwbNE&y.e-ZxOM3suX' );
define( 'SECURE_AUTH_SALT', 'VK$LGX}D;Vn!CDZe*kR}/<O~ eSM)Rk#fIS0Mh[|3|Yr8xj^K3Or-;%11~^8VB)A' );
define( 'LOGGED_IN_SALT',   '~_Y0I#h:@Et?T.`GZEUN=@Sr&]vAnk8]/tuv7{F z);TYK?iy%Mxx&b;BqaN1n-Q' );
define( 'NONCE_SALT',       's}m/e11LeVj8y64U0;Ud74wH9EQVb~vj9~Dn_`bK-cHwhz!05F:]L((jD<gO|(Zu' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);
define('FS_METHOD', 'direct');

//jwt Authentication

// Enable CORS for JWT
define('JWT_AUTH_CORS_ENABLE', true);

// Optional: Set a specific JWT secret key
define('JWT_AUTH_SECRET_KEY', 'Ajmal9539');

// Optional: Set allowed audience
// define('JWT_AUTH_AUD', 'your-domain.com');

// Optional: Set JWT token expiration time (in seconds)
define('JWT_AUTH_TOKEN_EXPIRATION', 9999999999999); // 1 hour
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
