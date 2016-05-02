<?php
require_once('TwitterAPIExchange.php');

$settings = array(
  'oauth_access_token' => "3508053016-0y9OtZt5r4EUL1dC3OvP6lHVWc4jt407Upst2jt",
  'oauth_access_token_secret' => "9EcfYr5oC1sYLNrn5AtjL69QHFshV3x43vZFx1FkyP6z3",
  'consumer_key' => "S0bQE3YouokDDyodwaKbqXcY4",
  'consumer_secret' => "DM52VnLBs4WLUYuHRlLCelU4lNK7vjnRBR8REUOHTT9JS7z054"
);

$userName = "hikozuma";

$twitter = new TwitterAPIExchange($settings);
$requestMethod = 'GET';
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

$getfield = '?screen_name=' . $userName . '&count=10';

$json = json_decode($twitter->setGetfield($getfield)
                  ->buildOauth($url, $requestMethod)
                  ->performRequest(), true);

if(array_key_exists("errors", $json)){
  echo json_encode(
        array(
        "code" => 401,
        "message" => "Not found user account in Twitter",
        "userId" => $userName));
  exit(0);
}


foreach($json as $tweet){
  $text[$username]["texts"][] = $tweet["text"];
  //echo $tweet["text"];
}

echo json_encode(
    array(
      "code" => 200,
      "userId" => $userName,
      "contents" => $text));

// don't forget the function, string urlencode ( string $str )

