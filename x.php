 <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <title>MiBlog</title>
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
$title = trim($title[0]);
$title = explode('| MauLon',$title);
$title = trim($title[0]);

$lay = curl_exec($curl);
$tt = $lay;
$tt = explode("Thông tin cơ bản",$tt);
$tt = explode("Gái gọi liên quan",$tt[1]);
$tt = trim($tt[0]);
$tt = strip_tags($tt,'<p>');


$lay = explode("<div class="ci" style="text-align: center;"><a name='more'>",$lay);
$lay = explode("<div class='post-info-icon label'>",$lay[1]);
$lay = trim($lay[0]);
$lay = strip_tags($lay,'<img>');
$thumb = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"<option>$2</option>",$lay);
$lay = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"[img]$2[/img]",$lay);
$thumb = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is","<option>$2</option>",$lay);
$lay = preg_replace("#<img(.*?)src='(.*?)'(.*?)>#is","[img]$2[/img]",$lay);
$lay =  str_ireplace('GaiGu.Pro','Truyenhentai.ViWap.Com' ,$lay);

curl_close($curl);


echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://truyenhentai.viwap.com/namon" method="post">
    Tiêu đề:<br />      
    <input name="ten" value="Bộ Ảnh Sex '.$title.'"><br />
    Thể loại:<br />  
    <select name="category">  
                    <optgroup label="Giải trí"> 
                                    <option value="4">Ảnh XXX</option>
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
    <textarea name="content" id="content" rows="25">
    '.$lay.'</textarea>
    <br />
    <div class="listm">tag <input type="text" name="tag" value="ảnh sex '.$title.', gai sex, gai xinh 18+,gai dep, gai goi cam, gai goi cao cap, gai lam tien, massage sung suong, dit toat hang" ></div>
<div class="list"><input type="checkbox" name="comment" value="1" checked> Cho phép bình luận</div>
  <div class="list"><input type="checkbox" name="comment" value="0" > Cho phép Phân Trang</div>
<div class="list"><center><button type="submit" class="btn btn-primary btn-block">Đăng bài</button></form></center></div>
</div> '; 



}

?>
