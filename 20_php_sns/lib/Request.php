<?php

namespace Lib;

class Request
{
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
