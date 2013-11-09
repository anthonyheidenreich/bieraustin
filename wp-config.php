<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db498256392');

/** MySQL database username */
define('DB_USER', 'dbo498256392');

/** MySQL database password */
define('DB_PASSWORD', 'BeerIsG00d!');

/** MySQL hostname */
define('DB_HOST', 'db498256392.db.1and1.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '9*c!]Z#<J8Y;r($;X-<2yW;2TzDJIZ/6ii(1j1|K,c4v~Fo.-|2RFsO1m6y1+c<u');
define('SECURE_AUTH_KEY',  '`jUah>:p0[vqNkDu(Rn/7ICs)NOw524V+LNq}$JXL`ki~j#Y3y8i;8PxuS?k1zcv');
define('LOGGED_IN_KEY',    '3?nHHj$z-B5D!{@`3/~X:V-a?+|-{v% O~iZmMLk-O9=CEThQ+*&vZ%N9!+La3U&');
define('NONCE_KEY',        '4Xqd$XRB_MD/#i893>Jz f+0P:HpUR8uUTvdLPqbpngFLZfH%MS[EJg<+qpp2p2F');
define('AUTH_SALT',        'LoeY5l=Q#U])|N-AA[Y E{8*sJ[TP|//`w|q_Q@,X_>&/_TOWaydCyeyqZ*<YKi^');
define('SECURE_AUTH_SALT', ')!uQ}<<EXm`5`M<lh|7ws0|m bg)zpC_fRiqj?8;67cS|`U|zvk=gVF?oG%<ZyBs');
define('LOGGED_IN_SALT',   '4j8Vm!-NkBdwH@F0t%H;fVIf0;ke`6Cl5CMr^gvzQ2ATE=y.aVs$*|OrPk9-c=K!');
define('NONCE_SALT',       '-M#M|gT%RQ2C+0fxX`AibHA$#~f^@BF~ Z9cFbSk#o67l&>@M2!]MHERl(~&7.FK');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
