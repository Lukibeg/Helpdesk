<?php

namespace app\helpers;

trait FlashMessages
{
    private function setFlash($message, $type)
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }
}
