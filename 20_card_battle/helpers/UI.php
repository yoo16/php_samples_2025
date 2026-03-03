<?php

class UI
{
    public function __construct() {}

    public static function getPercentage($current, $max)
    {
        if ($max <= 0) return 0;
        return (int)(($current / $max) * 100);
    }
}
