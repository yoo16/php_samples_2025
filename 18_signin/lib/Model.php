<?php

class Model
{
    protected static function pdo()
    {
        return Database::getInstance();
    }
}
