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
define('DB_NAME', 'e2_edu_vn');

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
define('AUTH_KEY',         'SB):i^4 .,Du`x|5HK/B2`y5c@ 6!?$>3xdvn&eCDO&R<Ud_@1^k)?Rq}OlUS]|8');
define('SECURE_AUTH_KEY',  'khQfSkLL,cbKh4<3/|jQ7|R3d<jHrG**aoOGQNB Ab5JWD5|q%=RG^(85t4xnw.-');
define('LOGGED_IN_KEY',    'VV1n),yHuV`|h*na>AgqYo&WO_lgVPy(!;/v1C%E<^pK1/1#,V9,{Su-Qlh;&TGD');
define('NONCE_KEY',        ',{IrH1Viv#9odK`~> t*Jgbak$5{3nJ[CvY/:kuXWrk;i_*=`R;[*>n][KCs$`tj');
define('AUTH_SALT',        '1:rH8Hg{P{,<<S1|}I-!N,gMOW6F#/WA2A*wFsFO9=[|_qT_$~#.&1f@4N,,bpW(');
define('SECURE_AUTH_SALT', 'Xp@-y}#,UxpS 0$[;}A*ar^C%g/v%m!;-cmcjQ}g0 -gzPEL0%=yRB0C/^$3@]K>');
define('LOGGED_IN_SALT',   'Nvn]@-8zbohD[snu :[-{gw_F{y(D83;=[b2+yym0=m#g-v/^q-~bXrew:wZ)(Kw');
define('NONCE_SALT',       'UFvO!,x-P3`z_e(vD^vFOfk_b4{W-CX^Vlp8LI|e&y0`]fDC>:N/~PM6*9DOqZ+i');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_e2blog';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);