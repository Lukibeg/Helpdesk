<?php

namespace App\Helpers;

trait FlashMessages
{
    private static function setFlash($message, $type)
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }
}
