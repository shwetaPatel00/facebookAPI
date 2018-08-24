<?php
session_start();
require 'Facebook/autoload.php'; 
$fb = new Facebook\Facebook([
  'app_id' => '1302602546542877',
  'app_secret' => '843c00e4c3cb3fa9624c724ab54854a0',
  'default_graph_version' => 'v3.1',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email,user_photos']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/rtcamp/album.php', $permissions);

header("location: " . $loginUrl);





?>