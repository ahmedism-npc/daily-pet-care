<?php
// AuthController (name)
$content = file_get_contents('app/Http/Controllers/AuthController.php');
$content = preg_replace("/'name'\s*=>\s*'required\|string\|max:255'/", "'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/'", $content);
file_put_contents('app/Http/Controllers/AuthController.php', $content);

// CustomerController (nama)
$content = file_get_contents('app/Http/Controllers/CustomerController.php');
$content = preg_replace("/'nama'\s*=>\s*'required\|string\|max:255'/", "'nama' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/'", $content);
file_put_contents('app/Http/Controllers/CustomerController.php', $content);

// UserController (name)
$content = file_get_contents('app/Http/Controllers/UserController.php');
$content = preg_replace("/'name'\s*=>\s*'required\|string\|max:255'/", "'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/'", $content);
file_put_contents('app/Http/Controllers/UserController.php', $content);

// StaffController (nama_staff)
$content = file_get_contents('app/Http/Controllers/StaffController.php');
$content = preg_replace("/'nama_staff'\s*=>\s*'required\|string\|max:255'/", "'nama_staff' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/'", $content);
file_put_contents('app/Http/Controllers/StaffController.php', $content);
