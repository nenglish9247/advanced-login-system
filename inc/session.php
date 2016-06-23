<?php
class session {
  public static function start() {
    ini_set('session.use_only_cookies', SESSION_USE_ONLY_COOKIES);
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], SESSION_SECURE, SESSION_HTTP_ONLY);
    session_start();
    if (SESSION_REGENERATE_ID) {
      session_regenerate_id(SESSION_REGENERATE_ID);
		}
	}
	public static function stop() {
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    session_destroy();
  }
}
?>
