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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'xsn9lkex_embajadores' );

/** MySQL database username */
// define( 'DB_USER', 'xsn9lkex_embajad' );
define( 'DB_USER', 'root' );

/** MySQL database password */
// define( 'DB_PASSWORD', 'A%FZ))cWY8Bk' );
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nQmKF|-u;P<k--QapTvfPvnvL<3iq-GHQCS] jx6YdH7^BJ_8*}/V)x`fax$sg2F' );
define( 'SECURE_AUTH_KEY',  ')mgO:y3MN-D+u1Pz+{6-r~Uap~Rf0PmE/9/_~D`$(Q5%>]nXpc~Y!/8e6eA0+79@' );
define( 'LOGGED_IN_KEY',    '@;_X6dc]O3OLVy7v*P/PDBR7mEn(ORFV^058!eJpTQ#n@4&SlIvSt`7[dQ!ui9+u' );
define( 'NONCE_KEY',        'T59JL!v:0Oj^yIC11ETa0N7fz]VC>6Te-AE!q RVv76wa10Mxchj_]Y`ot=Rj9VC' );
define( 'AUTH_SALT',        'uVB8jBmqGrydYO,@RHYT|lt<;rj9iv~+7`]h2N?GZLYi%^jVgyF*i1g_+gvHJx/Q' );
define( 'SECURE_AUTH_SALT', 'g454M}jG#%&kb286Dye*dD`#-f?1  vF_h9*$[q??jjL)GAi10A]0*DdgzaFB<V`' );
define( 'LOGGED_IN_SALT',   'ud=RKr:T@,KH?;)<U*$D C}>1cU|u4E^Ikv;tx|~{uY.(<A?K8s@aB0A#aaLFqVy' );
define( 'NONCE_SALT',       'sL6AC1SAB<47t!o(Q$bQUtACN~+)Yb2U<(Kb_ <U!AFp5]N`8)G3hr[Dt;@xhNh9' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
//define( 'WP_DEBUG', false );


//DEBUG
// Enable WP_DEBUG mode
define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
