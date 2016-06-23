<?php
date_default_timezone_set('UTC');

define('WEBSITE_NAME', '');
define('WEBSITE_DOMAIN', 'https://localhost');

define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

define('TWO_STEP_BUC_NUM', 6);
define('TWO_STEP_ENABLED', true);
define('TWO_STEP_BUC_NUM_LIFE', 10);
define('TWO_STEP_REQUIRED_STAFF', true);

define('SESSION_SECURE', true);
define('SESSION_HTTP_ONLY', true);
define('SESSION_REGENERATE_ID', true);
define('SESSION_USE_ONLY_COOKIES', true);

define('LOGIN_MAX_LOGIN_ATTEMPTS', 10);
define('RECAP_AFTER_LOGIN_ATTEMPT', 5);
define('LOGIN_FINGERPRINT', true);

define('PASSWORD_BCRYPT_COST', '15');
define('PASSWORD_SALT', '');
define('PWD_RESET_KEY_LIFE', 5);
define('ACC_ACT_KEY_LIFE', 10);

define('MAIL_ACT_REQUIRED', true);
define('REGISTER_CONFIRM_BASE_URL', '/check/k/comfirm');
define('REGISTER_PASSWORD_RESET_BASE_URL', '/check/k/forgot');

define('GOOGLE_ENABLED', false);
define('GOOGLE_ID', '');
define('GOOGLE_SECRET', '');

define('FACEBOOK_ENABLED', false);
define('FACEBOOK_ID', '');
define('FACEBOOK_SECRET', '');

define('TWITTER_ENABLED', false);
define('TWITTER_KEY', '');
define('TWITTER_SECRET', '');

define('DEFAULT_LANGUAGE', 'en');
?>
