<?php
$channel_id = "UC1SrxN8hxbmxj8z4XNlXSmg";

$url = "https://www.googleapis.com/youtube/v3/search?part=snippet" .
          "&channelId=" . $channel_id .
          "&maxResults=10" .
          "&order=date" .
          "&key=AIzaSyBjCHgrPD9c44v7IlM7M5JPVCl0Rtt_ulo";


$jsonData = file_get_contents($url);

if(!$jsonData){
  echo "nothing";
  exit(0);
}

$json = json_decode($jsonData, true);

if(!array_key_exists("items", $json)){
  echo "Not found Channnel ID";
  exit(0);
}

foreach($json["items"] as $video){

  // The last item has channelId, instead of videoId
  if(array_key_exists("videoId", $video["id"])){
    $videoInfo["videos"][] = array("title" => $video["snippet"]["title"],
                          "videoId" => $video["id"]["videoId"]);
  }
}

echo json_encode(array(
                  "code" => 200,
                  "channelId" => $channel_id,
                  "contents" => $videoInfo));
