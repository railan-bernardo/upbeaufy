<?php
/**
 * DATABASE
 */
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "db_app");

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.localhost/upbeauty");
define("CONF_URL_TEST", "https://www.localhost/upbeauty");

/**
 * SITE
 */
define("CONF_SITE_NAME", "Up Beauty");
define("CONF_SITE_TITLE", "On");
define("CONF_SITE_DESC",
    "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "site.com.br");
define("CONF_SITE_ADDR_STREET", "Endereço");
define("CONF_SITE_ADDR_NUMBER", "00");
define("CONF_SITE_ADDR_COMPLEMENT", "Complemento");
define("CONF_SITE_ADDR_CITY", "Cidade");
define("CONF_SITE_ADDR_STATE", "CD");
define("CONF_SITE_ADDR_ZIPCODE", "00000-000");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "@add");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@add");
define("CONF_SOCIAL_FACEBOOK_APP", "626690460695981");
define("CONF_SOCIAL_FACEBOOK_PAGE", "add");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "addoficial");
define("CONF_SOCIAL_GOOGLE_PAGE", "107305124528362639843");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "103958419096641225874");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "clean");
define("CONF_SOCIAL_YOUTUBE_PAGE", "clean");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "cafeweb");
define("CONF_VIEW_APP", "cafeapp");
define("CONF_VIEW_ADMIN", "cafeadm");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.sendgrid.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "apikey");
define("CONF_MAIL_PASS", "**********");
define("CONF_MAIL_SENDER", ["name" => "Name", "address" => "email@email.com"]);
define("CONF_MAIL_SUPPORT", "email@email.com");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");