
 <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <meta http-equiv="content-language" content="en"/>
      	
        <title>MiBlog</title>
        <meta name="robots" content="index,follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	    <link type="text/css" rel="stylesheet" href="http://thichtruyentranh.viwap.com/css/top18.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>

<?php
if (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text">
<br>idt:<input name="idt" type="text"><input type="submit" value="Leech" ></form>';
}
else
{
$url = $_GET['url'];
$url =  str_replace('http://m.','',$url);
$url =  str_replace('http://','',$url);
$url =  str_replace($url,'http://'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);

$idt = $_GET['idt'];

$title = curl_exec($curl);
$lay = explode('<p class="story-intro-chapper">  ',$title);
$lay = explode(' chương',$lay[1]);
$lay = trim($lay[0]);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = str_replace('- ThíchTruyện.VN','',$title);
$title = trim($title[0]);


$key = curl_exec($curl);
$key = explode('<div id="tab-chapper" class="tab">',$key);
$key = explode('<div id="tab-comment" class="tab">',$key[1]);
$key = str_replace('</p>','',$key);
$key = str_replace('<p>','',$key);
$key = trim($key[0]);
$key = strip_tags($key,'<ul>,<a>,<li>');
preg_match_all('/\<a href=\"(.+?)\"\>/is', $key, $chuong);
curl_close($curl);
	

$cuoi = '<!--Quảng Cáo Mobile-->';
$bv = curl_init();
for ($i= 1; $i <= $lay ; $i++) { 
curl_setopt ($bv, CURLOPT_URL, 'http://thichtruyen.vn.'.$chuong[1][($i-1)]);
curl_setopt ($bv, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($bv, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$bai = curl_exec($bv);
$bai = explode('<!--Quảng Cáo PC-->',$bai);
$bai = explode($cuoi,$bai[1]);
$bai = trim($bai[0]);
$bai =  str_replace('</div>
        <br><br>','' ,$bai);
$bai = strip_tags($bai,'<p>,<br>,<b>,<i>,<u>,<strong>');
$bai =  str_replace('        
        
        
        ','' ,$bai);
$bai =  str_replace('(adsbygoogle = window.adsbygoogle || []).push({});','' ,$bai);
$bai = preg_replace('/<p>(Chap|Chương|Phần)(.*)<\/p>/i', '<p><b>$1$2</b></p>', $bai);
$bai = preg_replace('#<(.*?)>#is',"[$1]",$bai);

$bai = preg_replace('/(thíchtruyện.vn|www.thichtruyen.vn|thichtruyen)/i', 'BaBaBa.Mobie.In', $bai);
$bai = preg_replace('/(Thích Truyện.VN)/i', 'Beautiful MyGirl', $bai);
echo ' Chương '.$i.'';
$post = array(
'idt' => $idt,
'content' => ' [b]Chương '.$i.'[/b][br] '.$bai.'',
  );
	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://thichtruyen.viwap.com/chap');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, count($post));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$result = curl_exec($ch);
curl_close($ch);
echo ' xong';
	
}
curl_close($bv);

	
//$bai = preg_replace('#<script(.*?)/script>#is',"<div>",$bai);


echo ' <br> leech tiếp <br>
<form method="get" action="http://xemlasuong.herokuapp.com/tool/thichtruyen.php">
Url: <input name="url" type="text"><br>
<input type="submit" value="Leech" ></form>';

}


?>
