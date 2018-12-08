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
$url =  str_replace('http://m.','',$url);
$url =  str_replace('http://','',$url);
$url =  str_replace($url,'http://'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$vll = $url;
$vll =  str_replace('http://','',$vll);
$vll =  str_replace('hentailx.com/','',$vll);
$vll =  str_replace('-1.html','',$vll);


$dow = curl_exec($curl);
$dow = explode('Thể loại:',$dow);
$dow = explode('Theo dõi:',$dow[1]);
$dow =  str_replace('</a>',',' ,$dow);
$dow = trim($dow[0]);
$dow = strip_tags($dow,'');
$dow = trim($dow);

$key = curl_exec($curl);
$key = explode('<meta name="Keywords" content="',$key);
$key = explode('<meta name="copyright"',$key[1]);
$key = preg_replace('#<img src="(.*?)" alt="(.*?)" />#is',"<option value='$1'>$1</option>",$key);
$key = str_replace('>','',$key);
$key = str_replace('/','',$key);
$key = str_replace('"','',$key);
$key = trim($key[0]);
$key = strip_tags($key,'');

$des = curl_exec($curl);
$des = explode('<meta name="description" content="',$des);
$des = explode('<link rel="canonical"',$des[1]);
$des = preg_replace('#<img src="(.*?)" alt="(.*?)" />#is',"<option value='$1'>$1</option>",$des);
$des = str_replace('"/>','',$des);
$des = str_ireplace('gaixinh9.com','truyenhay.botay.in',$des);
$des = str_replace('<p>','',$des);
$des = trim($des[0]);
$des = strip_tags($des,'<img>,<br>,<b>,<option>,<u>,<strong>');



$thumb = curl_exec($curl);
$thumb = explode('<div class="thumbnail row list-group-item">',$thumb);
$thumb = explode('</div></div><!-- Detail Images END -->',$thumb[1]);
$thumb = preg_replace('#<img width="(.*?)" height="(.*?)" onerror="(.*?)" src="(.*?)" class="(.*?)" alt="(.*?)" itemprop="(.*?)" />#is',"<option value='$4'>$4</option>",$thumb);
$thumb = preg_replace("#<img src='(.*?)' alt='(.*?)'/>#is",'<option value="$1">$1</option>',$thumb);
$thumb = preg_replace('#<img src="(.*?)" alt="(.*?)">#is',"<option value='$1'>$1</option>",$thumb);
$thumb = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"<option value='$2'>$2</option>",$thumb);
$thumb = str_replace('</div>','',$thumb);
$thumb = str_replace('</p>','',$thumb);
$thumb = str_replace('<p>','',$thumb);
$thumb = trim($thumb[0]);
$thumb = strip_tags($thumb,'<img>,<option>');


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
$title = explode('-',$title);
$title = trim($title[0]);


$nd = curl_exec($curl);
$nd = explode("<div class='post-body entry-content' id='post_body'>",$nd);
$nd = explode("<div style=' clear:both;'></div>",$nd[1]);
$nd= preg_replace('#<img src="(.*?)" alt="(.*?)" />#is',"[img]$1[/img]",$nd);
$nd= preg_replace('#<img border="(.*?)" src="(.*?)" />#is',"[img]$2[/img]",$nd);
$nd= preg_replace('#<img class="(.*?)" src="(.*?)" width="(.*?)" height="(.*?)" />#is',"[img]$2[/img]",$nd);
$nd = preg_replace('#m.vietgiaitri.com/tag/(.*?)/#is',"truyenhay.botay.in/tag/$1",$nd);
$nd = str_replace('</div>','',$nd);
$nd = str_replace('</p>','',$nd);
$nd = str_replace('<p>','',$nd);
$nd = trim($nd[0]);
$nd = strip_tags($nd,'<iframe>,<img>,<br>,<b>,<i>,<u>,<strong>');
curl_close($curl);

$pt = $_GET['pt'];
$pt = explode('.',$pt);
$bd = $pt[0];
$kt = $pt[1];
if ($bd > $lay || $kt > $lay || $bd > $kt )  {
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Truyện '.$title.' có '.$lay.' thôi mà !!';
}
else{
if (($kt && !$bd) || ($bd <= 1 && $kt > 0 )) {
$bd = 1;
$thong = 'Leech từ đầu đến trang '.$kt;
}
elseif (!$bd && !$kt ) {
$kt = $lay;
$bd = 1;
$thong = 'Đã leech tất cả '.$lay.' trang' ;
}
elseif (!$kt && $bd) {
$kt = $lay;
$thong = "Đã leech từ trang " .$bd." đến hết";
}
else {
$thong = 'Đã leech từ trang '.$bd.' đến trang '.$kt; 
}
echo '

	<b><u>'.$thong.'</u></b>';



echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://top18.viwap.com/namon" method="post">
    Tiêu đề:<br />  	
    <input name="ten" value="Truyện Hentai '.$title.' '.$lay.' Chap"><br />
    Thể loại:<br />  
    <select name="category">  
		      		<optgroup label="Giải trí">	
				              		<option value="4">Truyện Hentai</option>
              				</optgroup>
		    </select>  
    <br />
    Thumbnail<br />  
     <select name="thumb">  
		   <optgroup>	
	'.$thumb.'
              		 </optgroup>			
		    </select>  
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">[b] Truyện có '.$lay.' Chap[/b]';
if($kt == 1)
{
$cuoi = '<div class="container reading-pagination" id="reading-pagination-bottom">';
}
else {
$cuoi = '<div class="container reading-pagination" id="reading-pagination-bottom">';
}
$bv = curl_init();
for ($i= 1; $i <= $kt ; $i++) { 
curl_setopt ($bv, CURLOPT_URL, 'http://hentailx.com/doc-truyen/'.$vll.'-chapter-'.$i.'.html');
curl_setopt ($bv, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($bv, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$bai = curl_exec($bv);
$bai = explode('<div class="container" id="content_chap">',$bai);
$bai = explode($cuoi,$bai[1]);
$bai = trim($bai[0]);
$bai = strip_tags($bai,'<p>,<b>,<i>,<u>,<strong>,<img>');
$bai = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is','[img]$2[/img]
',$bai);
$bai = preg_replace('/<p>(Chap|Chương|Phần)(.*)<\/p>/i', '<p><b>$1$2</b></p>', $bai);
$bai = preg_replace('/(truyenvip.pro|truyenvip)/i', 'Top18.Viwap.Com', $bai);
echo '  [br][b]Chapter '.$i.'[/b]'.$bai.'  ';
}
curl_close($bv);



$t= strip_tags($bai,'');

$f= substr( $t, 0, 500);
echo '</textarea></textarea>
    <br />
    <input type="checkbox" name="comment" value="1" checked> Cho phép bình luận
     <button type="submit" class="btn btn-primary btn-block"id="eow">Đăng bài</button></div>
    </form>  
    
</div> '; 

}

}

?>
