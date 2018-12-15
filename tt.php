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


$thumb = curl_exec($curl);
$thumb = explode('<meta property="og:image" content="',$thumb);
$thumb = explode('<meta property="og:image:width" content',$thumb[1]);
	
$thumb = str_replace('" />','',$thumb);
$thumb = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"$2",$thumb);
$thumb = trim($thumb[0]);



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
  
        <form action="http://thichtruyentranh.viwap.com/manager/post" method="post">
    Tiêu đề:<br />  	
    <input name="ten" value="Truyện Hentai '.$title.'"><br />
    Thể loại:<br />  
    <select name="category">  
		      		<optgroup label="Giải trí">	
				              		<option value="2">Truyện Hentai</option>
              				</optgroup>
		    </select>  
    <br />
    Thumbnail<br />  
     <input name="thumb" value="'.$thumb.'"/>
              		
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">Đọc Truyện Hentai '.$title.' cập nhật liên tục tại Thichtruyentranh.viwap.com</textarea>
        <br />
    <input type="checkbox" name="comment" value="1" checked> Cho phép bình luận
     <button type="submit" class="btn btn-primary btn-block"id="eow">Đăng bài</button></div>
    </form> 
 <div class="row">   
   ';
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
$bai = preg_replace('/<p>(Chap|Chương|Phần)(.*)<\/p>/i', '<p><b>$1$2</b></p>', $bai);
//$bai = preg_replace('/(hentai24h.org|truyenvip)/i', 'thichtruyentranh.viwap.com', $bai);
echo ' <div class="col-xs-4 col-sm-4 col-md-4 col-ld-4"><form action="http://thichtruyentranh.viwap.com/manager/chap/'.$idt.'" method="post"> Truyen goc: <input type="text" name="idt" value="'.$idt.'" maxlength="300">
Nội dung: <textarea name="content" id="content" rows="25">'.$bai.'</textarea>
<input type="checkbox" name="comment" value="1" checked> Cho phép bình luận
<button type="submit" class="btn btn-primary btn-block">Đăng bài</button></form></div>';
}
curl_close($bv);



$t= strip_tags($bai,'');

$f= substr( $t, 0, 500);


}

}

?>
