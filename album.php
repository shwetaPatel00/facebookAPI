<?php
session_start();
require_once("includes.php");

$fb = new Facebook\Facebook([
  'app_id' => '1302602546542877',
  'app_secret' => '843c00e4c3cb3fa9624c724ab54854a0',
  'default_graph_version' => 'v3.1',
  ]);
  
  $helper = $fb->getRedirectLoginHelper();

  
try {
  // Returns a `Facebook\FacebookResponse` object
  $accessToken = $helper->getAccessToken();
  $response = $fb->get('/me?fields=id,name,email,link,albums{description,link,cover_photo,count}', $accessToken);
  $user = $response->getGraphUser();
  
  $graphNode = $response->getGraphNode();
echo 'Name: ' . $user['name'];
echo 'Name: ' . $user['albums'];
echo 'name ' . $user['link'];
//$fbAlbumData = $user['albums'];
$fbAlbumData = array($user['albums']);
foreach( $fbAlbumData as $user ){
    $id = isset($data['id'])?$data['id']:'';
    $name = isset($data['name'])?$data['name']:'';
    $description = isset($data['description'])?$data['description']:'';
    $link = isset($data['link'])?$data['link']:'';
    $cover_photo_id = isset($data['cover_photo']['id'])?$data['cover_photo']['id']:'';
    $count = isset($data['count'])?$data['count']:'';
    
    $pictureLink = "photos.php?album_id={$id}&album_name={$name}";
    
    echo "<div class='fb-album'>";
    echo "<a href='{$pictureLink}'>";
    echo "<img src='https://www.facebook.com//{$cover_photo_id}/picture?access_token={$accessToken}' alt=''>";
    echo "</a>";
    echo "<h3>{$name}</h3>";

    $photoCount = ($count > 1)?$count. 'Photos':$count. 'Photo';
    
    echo "<p><span style='color:#888;'>{$photoCount} / <a href='{$link}' target='_blank'>View on Facebook</a></span></p>";
    echo "<p>{$description}</p>";
    echo "</div>";
}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}







?>