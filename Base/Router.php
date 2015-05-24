<?php

namespace Base;

class Router
{
    static function getController()
    {
        if(isset($_GET['r']))
        {
            $get_arr = explode('/', $_GET['r']);
            if(isset($get_arr[1]))
                return ucfirst($get_arr[1]);
            else
                throw new \Exception("Error 404. Sorry. This page doees not exist.");
        }
        else
            return 'Index';
    }
}