<?php
$accessToken = '3182465397.9349829.7b30073887174260893e0acb1968369f';
$userId = 3182465397; // ユーザーID
$count = 10; // 取得件数

$url = 'https://api.instagram.com/v1/users/' . $userId .
        '/media/recent?access_token=' . $accessToken .
        '&count=' . $count .
        'scope=public_content';

$jsonData = file_get_contents($url);

if(!$jsonData){
  echo "nothing";
  exit(0);
}

// jsonデータの整形・出力
$json = json_decode($jsonData, true);


// whether API composition are modified
if(!array_key_exists("data", $json)){
  echo "API was modified.";
  exit(0);
}


foreach($json["data"] as $product){
  $image = $product["images"];
  //$lowResolutionImage[] = $image["low_resolution"]["url"];
  //$standardResolutionImage[] = $image["standard_resolution"]["url"];

  $extractedImage["images"][] = array("lowResolution" => $image["low_resolution"]["url"],
                                    "standardResolution" => $image["standard_resolution"]["url"]);
}

$contents["lowRsolution"] = $lowResolutionImage;
$contents["standardResolution"] = $standardResolutionImage;

echo json_encode(array(
                  "code" => 200,
                  "user_id" => $userId,
                  "contents" => $extractedImage));