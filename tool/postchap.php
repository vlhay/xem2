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
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><input name="sotrang" type="text">
<br>idt:<input name="idt" type="text"><input type="submit" value="Leech" ></form>';
}
else
{
$url = $_GET['url'];
$url =  str_replace('http://m.','',$url);
$url =  str_replace('http://','',$url);

$url =  str_replace('https://','',$url);
$url =  str_replace($url,'https://'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$vll = $url;
$vll =  str_replace('https://','',$vll);
$vll =  str_replace('hentai24h.org/','',$vll);
$vll =  str_replace('.html','',$vll);



$sotrang = $url = $_GET['sotrang'];
$idt = $_GET['idt'];





$url1= "'$url";

$title = curl_exec($curl);		
$lay = explode('update <a href="/doc-truyen/'.$vll.'-chapter-',$title);
$lay = explode('.html" class="chap-link">Chapter',$lay[1]);
$lay = trim($lay[0]);
if (!$lay){
$lay = explode('<!--Chapter List label-->',$title);
$lay = explode('<span class="sr-only">(current)</span>',$lay[1]);
$lay = strip_tags($lay[0]);
$lay = trim($lay);
$lay = substr($lay, -1 , 1 );
}
if (!$lay){$lay = 1;}
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = trim($title[0]);
curl_close($curl);




if($kt == 1)
{
$cuoi = '<hr class="chapter-end"/>';
}
else {
$cuoi = '<hr class="chapter-end"/>';
}
$bv = curl_init();
for ($i= 1; $i <= $sotrang ; $i++) { 
curl_setopt ($bv, CURLOPT_URL, 'https://hentai24h.org/'.$vll.'/chap-'.$i.'.html');
curl_setopt ($bv, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($bv, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$bai = curl_exec($bv);
$bai = explode('<div class="content-child">',$bai);
$bai = explode($cuoi,$bai[1]);
$bai = trim($bai[0]);
$bai = strip_tags($bai,'<img>');
$bai = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is','[img]$2[/img]',$bai);
$bai = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is",'[img]$2[/img]',$bai);
$bai = preg_replace('/<p>(Chap|Chương|Phần)(.*)<\/p>/i', '<p><b>$1$2</b></p>', $bai);
//$bai = preg_replace('/(hentai24h.org|truyenvip)/i', 'thichtruyentranh.viwap.com', $bai);
echo ' Chap '.$i.'';
$post = array(
    'idt' => $idt,
     'content' => $bai,
  );
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://thichtruyentranh.viwap.com/chap');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$result = curl_exec($ch);
curl_close($ch);
echo 'xong';

}
curl_close($bv);



$t= strip_tags($bai,'');

$f= substr( $t, 0, 500);


}



?>
