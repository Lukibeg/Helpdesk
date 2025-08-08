<?php

namespace core;

class SessionManager
{

    private static $sessionManager = null;

    private function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function getInstance(): SessionManager
    {
        if (self::$sessionManager === null) {
            self::$sessionManager = new SessionManager();
        }
        return self::$sessionManager;
    }
    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public function getSession($key)
    {
        return $_SESSION[$key];
    }
    public function destroySession()
    {
        unset($_SESSION['user']);
    }
}
