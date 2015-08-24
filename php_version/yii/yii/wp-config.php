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
define('DB_NAME', 'alexand2_wpyii');

/** MySQL database username */
define('DB_USER', 'alexand2_wpyii');

/** MySQL database password */
define('DB_PASSWORD', '7(g4Sg-G1P');

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
define('AUTH_KEY',         'wips37uwajdvw42f5a4dnhihourmixks5gbwmx5twxqfjv40m0s16sdbwo51eehg');
define('SECURE_AUTH_KEY',  'x3iycpnqsxkvcdfiivkigkamexqd2pufulwffgoaujtmu3s1cbirfvuuqhhw4mmc');
define('LOGGED_IN_KEY',    'pftbs1ai69k7g8hncwsnrphcpkeco7vhhmsgtttlnl84jdcppxphw9ipilnbod5m');
define('NONCE_KEY',        'q92hhvsb0iiauef4jh5ohqknkjuj8wyqy9ukt9nhqyfz4l3mwss0ex2uhoma81ro');
define('AUTH_SALT',        'p8j00qohisemt69dhwdykfc6kb3zrnasmc4jlbxaswxkvgqkyanuwit8uujsoluc');
define('SECURE_AUTH_SALT', 'eslbrl7gdgwxcidsrfefs9afpwegaevhk4vbulvrtsez7lje4slnxxxgalackp1i');
define('LOGGED_IN_SALT',   '66dxliwo8evtygv0qcnr0buwkndvt8zrn6alenc1v4i8sru7e2fb6jy8ex6jwlcg');
define('NONCE_SALT',       'ag9mcfcgxkg0rlv8cseappkkhkcl9qzpyehulynoc9rmkchtijbpa0ktxsaqe8od');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_yii';

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
