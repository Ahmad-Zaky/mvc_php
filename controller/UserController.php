<?php

require_once "..". DIRECTORY_SEPARATOR ."app". DIRECTORY_SEPARATOR ."Controller.php";
require_once "..". DIRECTORY_SEPARATOR ."model". DIRECTORY_SEPARATOR ."User.php";

class UserController extends Controller
{
    public function index()
    {
        $this->view('users.index', ["users" => (new User)->all()]);
    }

    public function show()
    {
        User::create([
            "name" => "Ali"
        ]);

        $this->view('users.show', ["user" => (new User)->find(1)]);
    }

    public function store()
    {
        User::create([
            "name" => "Ali"
        ]);

        echo "success";
    }
}