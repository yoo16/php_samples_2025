<?php
class Controller
{
    public function __construct() {}

    public function render($view, $data = [])
    {
        extract($data);
        require VIEW_DIR . $view;
    }
}
