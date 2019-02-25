<?php
session_start();
if (isset($_GET['url']))

{
	if($_GET[td] == 'android')
	{
	$td = 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19';
	}
	elseif($_GET[td] == 'java')
	{
	$td = 'NokiaN97/21.1.107 (SymbianOS/9.4; Series60/5.0 Mozilla/5.0; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebkit/525 (KHTML, like Gecko) BrowserNG/7.1.4';
	}
	else
	{
	$td = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/45.0 Chrome/39.0.2171.95 Safari/537.36';
	}
$link = 'http://xemlasuong.viwap.com/'.$_GET['link'];
$cl = $_GET['chatluong'];
$url = $_GET['url'];
$url = preg_replace('#(https://|http://)(.*)#i', '$1$2', $url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, $td);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = curl_exec($curl);
if ($cl == '720P' ){ 		
$lay = explode('720","videoUrl":"',$lay);
$lay = explode('"},{"defaultQuality',$lay[1]);}
elseif ($cl == '480P'){
$lay = explode('480","videoUrl":"',$lay);
$lay = explode('"},{"defaultQuality',$lay[1]);}
elseif ($cl == '240P'){
$lay = explode('240","videoUrl":"',$lay);
$lay = explode('\"}],\"video_unavailable_country',$lay[1]);}
$lay = $lay[0];
$lay =  str_replace('\\','' ,$lay);
	$lay =  str_replace('&','@' ,$lay);
curl_close($curl);
//header('Location: '.$_SERVER["HTTP_REFERER"].'?url='.$lay.'');
header('Location: '.$link.'?url='.$lay.'');   
}
    
?>


