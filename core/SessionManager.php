<?php

namespace core;

use GuzzleHttp\Psr7\Response;

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

    public function regenerateSession()
    {
        session_regenerate_id(true);
    }

    public function getUserSession()
    {
        if (isset($_SESSION['user']) && $_SESSION['user'] !== null) {
            return $_SESSION['user'];
        } else {
            $this->destroySession();
            return new Response(401, ['Location' => '/login']);
        }
    }

    public function getSuccessSession()
    {
        return $_SESSION['success'] ?? false;
    }

    public function getErrorSession()
    {
        return $_SESSION['error'] ?? false;
    }


    public function destroySession()
    {
        unset($_SESSION);
        session_destroy();
        return new Response(302, ['Location' => '/login']);
    }
}
