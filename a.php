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
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<br> lêch xlecx.org<br>
<form method="get">Url: <input name="url" type="text"><input type="submit" value="Leech" ></form>';
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
$title = explode('&raquo;',$title[0]);
$title = trim($title[0]);


$key = curl_exec($curl);
$key = explode('<meta name="news_keywords" content="',$key);
$key = explode('">
<meta property="og:image"',$key[1]);
$key = strip_tags($key[0],);
$key = trim($key);

$thumb = curl_exec($curl);
$thumb = explode('<div style="text-align:center;">',$thumb);
$thumb = explode('<!--dle_image_end--></div></div>',$thumb[1]);
$thumb = trim($thumb[0]);
$thumb = strip_tags($thumb,'<img>');
$thumb = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"<option>http://xlecx.org$2</option>",$thumb);
$thumb = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is","<option>http://xlecx.org$2</option>",$thumb);
$thumb = trim($thumb);

$lay = curl_exec($curl);
$lay = explode('<div style="text-align:center;">',$lay);
$lay = explode('<!--dle_image_end--></div></div>',$lay[1]);
$lay = trim($lay[0]);
$lay = strip_tags($lay,'<img>');
$lay = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is",'[img]http://xlecx.org$2[/img]',$lay);
$lay = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is','[img]http://xlecx.org$2[/img]',$lay);
$lay = trim($lay);

curl_close($curl);



echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://truyenhentai.viwap.com/namon" method="post">
    Tiêu đề:<br />  	
    
    <input name="ten" value="Truyện Hentai '.$title.'"><br />

    <select name="category">  
		      		<optgroup label="Giải trí">	
				              		<option value="3">Ảnh Girl Xinh</option>
              				</optgroup>
		    </select>  
    <br />
    Thumbnail<br />  
     
		        <select name="thumb">  
                    <optgroup label="Chuyên Mục">   
                                    '.$thumb.'
                            </optgroup>
            </select> 
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">'.$lay.'</textarea>
    <br />
      Từ Khóa:<br />  
  <div class="listm">tag <input type="text" name="tag" value="Truyện Hentai '.$title.' full,'.$key.', truyen hentai, truyen loan luan, truyen nguoi lon, hentai dam, hentai tai mau, full color, anime sex" ></div>
<div class="list"><input type="checkbox" name="comment" value="1" checked> Cho phép bình luận</div>
  <div class="list"><input type="checkbox" name="comment" value="0" > Cho phép Phân Trang</div>
<div class="list"><center><button type="submit" class="btn btn-primary btn-block"  id="autoid" >Đăng bài</button></form></center></div>
</div>


<script>
window.setTimeout (\'clickit ()\', 5000);
function clickit () {
   location.href = document.getElementById ("autoid")
</script>
 '; 

}

?>
