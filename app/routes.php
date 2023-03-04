<?php

Route::get('/test/[0-9]*', function () { echo "test route"; });
Route::get('users', "UserController", "index");
Route::get('users/[0-9]*', "UserController", "show");
