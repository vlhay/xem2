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
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><input type="submit" value="Leech" ></form>';
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


$dow = curl_exec($curl);
$dow = explode('<div class="pull-left story-intro-image">',$dow);
$dow = explode('<div class="story-introduction-content pull-left">',$dow[1]);
$dow = trim($dow[0]);
$dow = strip_tags($dow,'<img>');
$dow = preg_replace('#(.*?)<img src="(.*?)" alt="thích truyện"/>(.*?)#is',"$2",$dow);






$title = curl_exec($curl);
$lay = explode('<p class="story-intro-chapper">  ',$title);
$lay = explode(' chương',$lay[1]);
$lay = trim($lay[0]);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = str_replace('- ThíchTruyện.VN','',$title);
$title = trim($title[0]);



$nd = curl_exec($curl);
$nd = explode('<div class="tab-text text-justify">',$nd);
$nd = explode('Đọc Truyện</a></p>',$nd[1]);
$nd = trim($nd[0]);
$nd= preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"[img]$2[/img]",$nd);
$nd = str_replace('</p>','[p]',$nd);
$nd = str_replace('<p>','[/p]',$nd);
$nd = strip_tags($nd,'<img>,<br>,<b>,<i>,<u>,<strong>,<p>');

$nd= preg_replace('#<(.*?)>#is',"[$1]",$nd);
curl_close($curl);



echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://thichtruyen.viwap.com/asdfdhfgjgjl" method="post">
    Tiêu đề:<br />  	
    <input name="ten" value="'.$title.'"><br />
    Thể loại:<br />  
    <select name="category">  
		      		<optgroup label="Giải trí">	
				              		<option value="2">Truyện Ngôn Tidnh</option>
              				</optgroup>
		    </select>  
    <br />
    Thumbnail<br />  
     <input name="thumb" value="'.$dow.'"/>
     <input type="hidden" name="trang" value="'.$url.'"/>        		
    <br />
    Nội dung:<br />  
    '.$nd.'';
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
$bai = preg_replace('#<script(.*?)/script>#is',"<div>",$bai);
$bai = strip_tags($bai,'<p>,<br>,<b>,<i>,<u>,<strong>');
$bai = preg_replace('/<p>(Chap|Chương|Phần)(.*)<\/p>/i', '<p><b>$1$2</b></p>', $bai);
$bai = preg_replace('#<(.*?)>#is',"[$1]",$bai);
$bai = str_replace('

','
',$bai);
//$bai = preg_replace('/(thíchtruyện.vn|www.thichtruyen.vn|thichtruyen)/i', 'thichtruyentranh.viwap.com', $bai);
$bai = preg_replace('/(Thích Truyện.VN)/i', 'Beautiful MyGirl', $bai);
echo ' Chap '.$i.' <textarea> '.$lay.'</textarea> 
    
    
    </textarea>
        <br />
    <input type="checkbox" name="comment" value="1" checked> Cho phép bình luận
     <button type="submit" class="btn btn-primary btn-block"id="eow">Đăng bài</button></div>
    </form> </div>';
 

}


?>
