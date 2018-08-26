<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cRedirect extends Control
{
    public function re($class, $method = 'index')
    {
        return call_user_func('a' . ucfirst($class) . '::' . $method);
    }
}
