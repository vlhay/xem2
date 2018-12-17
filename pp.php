
<?php
$url = $_GET['url'];
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$link = curl_exec($curl);
$link = explode('<title>',$title);
$link = explode('</title>',$title[1]);
$link = trim($title[0]);

echo ''.$title.'';
?>
