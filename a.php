 <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <meta http-equiv="content-language" content="en"/>
      	
        <title>MiBlog</title>
        <meta name="robots" content="index,follow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    	<link type="text/css" rel="stylesheet" href="http://cuocsong.viwap.com/css/admin-style.css?v=472256984">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>

<?php
	    
	    
if (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><input type="submit" value="Leech" ></form>';
}
else
{

$url = $_GET['url'];
$url = preg_replace('#(https://|http://)(.*)#i', '$1$2', $url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$title = curl_exec($curl);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = explode('|',$title[0]);
$title = trim($title[0]);

$key = curl_exec($curl);
$key = explode('<meta name="keywords" content="',$key);
$key = explode('18+">',$key[1]);
$key = strip_tags($key[0],);
$key = trim($key);


$thumb = curl_exec($curl);
$thumb = explode('<div class="bar-title">Ảnh bìa truyện</div>',$thumb);
$thumb = explode('function chapterdoAction(chapter_id,chapter_type)',$thumb[1]);
$thumb = strip_tags($thumb[0],'<img>');
$thumb = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"$2",$thumb);
$thumb = trim($thumb);

$link = curl_exec($curl);
$link = explode('<table class="listing">',$link);
$link = explode('Oneshot</h2></a>',$link[1]);
$link = strip_tags($link[0],'<a>');
$link = preg_replace('#<a(.*?)href="(.*?)"(.*?)>#is',"$2",$link);
$link = trim($link);

curl_close($curl);


echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://truyenhentai.viwap.com/namon" method="post">
    Tiêu đề:<br />  	
    md_keys_google($value)
    <input name="ten" value="'.$title.'"><br />

    <select name="category">  
		      		<optgroup label="Giải trí">	
				              		<option value="3">Ảnh Girl Xinh</option>
              				</optgroup>
		    </select>  
    <br />
    Thumbnail<br />  
     <input name="thumb" rows="25" value="'.$thumb.'">		
		   
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">';
    $bv = curl_init(); 
curl_setopt ($bv, CURLOPT_URL, 'https://hentaivn.net'.$link);
curl_setopt ($bv, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($bv, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$bai = curl_exec($bv);
$bai = explode('<div class="bot-episode" style="margin-top: 20px;">',$bai);
$bai = explode('<div class="bot-episode">',$bai[1]);
$bai = trim($bai[0]);
$bai = strip_tags($bai,'<img>');
$bai = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is",'[img]$2[/img]',$bai);
$bai = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is','[img]$2[/img]',$bai);
$bai = preg_replace('/<p>(Chap|Chương|Phần)(.*)<\/p>/i', '<p><b>$1$2</b></p>', $bai);
curl_close($bv);
echo $bai.' </textarea>
    <br />
  <div class="listm">tag <input type="text" name="tag" value="'.$title.','.$key.'18+, truyen he ntai, truyen loan luan, truyen nguoi lon, hentai dam, hentai tai mau, full color, anime sex" ></div>
<div class="list"><input type="checkbox" name="comment" value="1" checked> Cho phép bình luận</div>
  <div class="list"><input type="checkbox" name="comment" value="0" > Cho phép Phân Trang</div>
<div class="list"><center><button type="submit" class="btn btn-primary btn-block">Đăng bài</button></form></center></div>
</div>
 '; 

}

?>
