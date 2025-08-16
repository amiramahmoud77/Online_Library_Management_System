<?php
require __DIR__.'/vendor/autoload.php'; 
use Illuminate\Support\Facades\Hash;

$password = 'admin123'; 
$hashed = Hash::make($password);
echo $hashed;