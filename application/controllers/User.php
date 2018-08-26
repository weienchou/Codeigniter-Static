<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cUser extends Control
{
    public static function index()
    {
        parent::_echo('demo', 'test', ['abc']);
    }
}
