<?php

namespace Lib;

class Request
{
    /**
     * POSTリクエストかどうかを返す
     * @return bool
     */
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
