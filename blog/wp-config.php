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
define('DB_NAME', 'ihd_wrdp1');

/** MySQL database username */
define('DB_USER', 'ihd_wrdp1');

/** MySQL database password */
define('DB_PASSWORD', 'YNbUYWAg0J8iJxMu');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '3::%lSQ+ G#Ktf7[d0=[Ppgm+mR-2UfS@!f`,tRWB{w>Mh,`h!~`%AaS{A9Mn?3I');
define('SECURE_AUTH_KEY',  'B4{|3(Rp,[-7RrW+<2DBK50+rQ{kRtPzAqB^+*D,9Xug|)zL^MV%#f )Hw$WX2H}');
define('LOGGED_IN_KEY',    '@(B*T+NP?Oyw)K.R?adUh`|I{M3knaW)41<cTkxl0q:{=>/P:a0aPbffm42T+16I');
define('NONCE_KEY',        'ofHoI+`Zl+Q^^$fe,&!DyE_~z=d)Xvk9x6LP*sj-SPq_K6FFe5ubY9-(#FH6w-?%');
define('AUTH_SALT',        '*%N(D-2V|[>e}|GOrkLaKL6]B2#u`(?Kow>9$c$orBL0^D0nR(]kz&SK2u7GwP^6');
define('SECURE_AUTH_SALT', 'Io!M92cxy*b1~S>LC|xguh![a`n@-Jp23+8kYJRg mMPx$.<9w[Bg9P8n(|U.zHt');
define('LOGGED_IN_SALT',   '.|?*gpv.=DR$0y|`)J[3O,)_w%]gC@i*l/v!3p&Ew@l;+PpWX/{|:Wr|lcc?beo9');
define('NONCE_SALT',       'aG1|YR9B49T_SmZ( Q%0roWR6j&6UhG}6q/YPz=&x/d3k @Etx<1>1H]!Vwj+0C2');

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
