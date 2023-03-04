<?php

class Controller
{
    protected function view($fileName = "", $data = [])
    {
        extract($data);
        
        $path = str_replace(".", DIRECTORY_SEPARATOR , $fileName);

        require_once "..". DIRECTORY_SEPARATOR ."view". DIRECTORY_SEPARATOR ."{$path}.php";
    }
}
