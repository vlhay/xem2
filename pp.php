
<?php
$url = $_GET['url'];
$url =  str_replace('ooooo','?',$url);

$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$link = curl_exec($curl);
$link = explode('<title>',$link);
$link = explode('</title>',$link[1]);
$link = trim($title[0]);

echo ''.$link.'';
?>
