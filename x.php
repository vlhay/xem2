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
$nguon = explode('//',$url);
$nguon = explode('/',$nguon[1]);
$nguon = trim($nguon[0]);


if ($nguon == 'goikieu.com')
 {
$dl ='<!-- .entry-header -->';
$cl ='<!-- .entry-content -->';
$cmm = "4";
$dk ='<h5 class="entry-cat">Khu vực:';
$ck = '<h5 class="entry-date">';
$tit ='- Gaigoi.org';
}
elseif ($nguon == 'girlchanh.com')
 {
$dl ='Girl Chảnh</a> </dd> </dl> </div> </div> <span class="message-userArrow"></span> </section> </div> <div class="message-cell message-cell--main"> <div class="js-quickEditTarget message-main uix_messageContent">';
$cl ='#1</a> </div> </header>';
$cmm = "4";
$dk ='<meta name="keywords" content="';
$ck = '" /> <meta name="google-site-verification"';
$tit ='- hhkjkb';
}


$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');

$title = curl_exec($curl);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = explode($tit,$title[0]);
$title = trim($title[0]);


$key = curl_exec($curl);
$key = explode($dk,$key);
$key = explode($ck,$key[1]);
$key = strip_tags($key[0],);
$key = trim($key);

$thumb = curl_exec($curl);
$thumb = explode($dl,$thumb);
$thumb = explode($cl,$thumb[1]);
$thumb = trim($thumb[0]);
$thumb = strip_tags($thumb,'<img>');
$thumb = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"<option>$2</option>",$thumb);
$thumb = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is","<option>$2</option>",$thumb);
$thumb = trim($thumb);


$link = curl_exec($curl);
$link = explode('<table class="listing">',$link);
$link = explode('Oneshot</h2></a>',$link[1]);
$link = strip_tags($link[0],'<a>');
$link = preg_replace('#<(.*?)href="(.*?)"(.*?)>#is',"<option>$2</option>",$link);
$link = trim($link);

$lay = curl_exec($curl);
$lay = explode($dl,$lay);
$lay = explode($cl,$lay[1]);
$lay = trim($lay[0]);
$lay = strip_tags($lay,'<img><p>');
$lay = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is",'[img]$2[/img]',$lay);
$lay = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is','[img]$2[/img]',$lay);
$lay = preg_replace('#<(.*?)>#is','[$1]',$lay);
$lay = trim($lay);

curl_close($curl);

echo '
<div id="main">      
                <h3>Viết bài</h3>
<div class="box">
  
        <form action="http://truyenhentai.viwap.com/namon" method="post">
    Tiêu đề:<br />      
    <input name="title" value="Ảnh Sex '.$title.'"><br />
    Thể loại:<br />  
    <select name="category">  
                    <optgroup label="Chuyên Mục">   
                                    <option value="'.$cmm.'">Truyện Chữ</option>
                            </optgroup>
            </select>  
    <br />
    Thumbnail<br />  
    <select name="thumbnail">  
                    <optgroup label="Chuyên Mục">   
                                   '.$thumb.'
                            </optgroup>
            </select> 
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">'.$lay.'[p]Nguồn : '.$nguon.'[/p]</textarea>
    <br />
      Từ Khóa:<br />  
    <input name="tag" rows="25" value="'.$title.','.$key.', ảnh sex, ảnh gái gọi, gái xinh, gái cập nhật, ảnh sex dep, anhsexdep"><br>
      <input type="checkbox" name="phantrang" value="0" > Cho phép phan trang<br>
    <input type="checkbox" name="html" value="1" checked> Cho phép html<br>
    <input type="checkbox" name="allowComment" value="1" checked> Cho phép bình luận
      <div class="frm-buttons"><button>Đăng bài</button></div>
    </form>  
</div>  '; 

}

?>