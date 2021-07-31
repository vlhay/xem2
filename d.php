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

  include_once 'func.php';


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
$key = explode('<div class="bai-viet-box"><strong>Phân loại:',$key);
$key = explode('<div class="phdr"><h2>Bình luận</h2></div>',$key[1]);
$key = strip_tags($key[0],);
$key = trim($key);

$lay = curl_exec($curl);
$lay = explode('<div class="bai-viet-box"><strong>Danh sách các phần:',$lay);
$lay = explode('<div class="bai-viet-box"><strong>Phân loại:',$lay[1]);

$lay = strip_tags($lay[0],'<a>');

$lay = preg_replace('/TruyenTv.net|truyentv.net/i', 'TruyenHentai.Viwap.Com', $lay);
$lay = str_replace('</p>','[/p]',$lay);
$lay = str_replace('<p>','[p]',$lay);
$lay = str_replace('</b>','[/b]',$lay);
$lay = str_replace('<b>','[b]',$lay);
$lay = str_replace('</center>','[/center]',$lay);
$lay = str_replace('<center>','[center]',$lay);

$lay = trim($lay);












curl_close($curl);

$a = 'https://lh5.googleusercontent.com/-oGgHZIAs1CY/V-VHAfple-I/AAAAAAAA6GA/Y7Y78dBiOOM8pc_YywhA4FVVlE-xIsaSwCLcB/s1600/gaixinhxinh.com-bololi-xiuren-280110816.jpg';
$b = 'https://lh5.googleusercontent.com/-JmUccxOJMjY/V-VG_sT2NdI/AAAAAAAA6F0/f4AFiquqlUQX9YtYwm3WqC7K6nAuCovDACLcB/s1600/gaixinhxinh.com-bololi-xiuren-2775110816.jpg';
$c = 'https://lh3.googleusercontent.com/-gHRRcshTPJ0/WPjJftDAJ0I/AAAAAAABKeQ/jJtK2H4sznUEjIetw14ThKUi2FQuoKv6ACLcB/s1600/GaiXinhXinh-mygirl-hk-xiuren-433831216.jpg';
$d ='https://lh5.googleusercontent.com/-nXgP091HxxQ/V9yEot8rWVI/AAAAAAAA5cY/RgnkUg8YaLUoi0AiePNxOKKoAjVv6xzgACLcB/s1600/gaixinhxinh.com-bololi-xiuren-153811016.jpg' ;
$e ='https://lh5.googleusercontent.com/-sqE5Hbwrgcw/V61e8HebHXI/AAAAAAAA0ks/nJlNK4kj9GcnVlM--D_BawMgq_YvzLX1ACLcB/s1600/gaixinhxinh.com-bololi-xiuren-009610816.jpg' ;
$f ='http://2.bp.blogspot.com/-S-3aWbcPevc/VJ054x-DeBI/AAAAAAAACnc/NI6FDddZmE4/s1600/Ngam-Hot-Girl-Midu-Voi-Ao-Dai-1.jpg' ;
$g ='http://lh4.googleusercontent.com/-D8wu3EhC0Z8/VZ-VhXhSxiI/AAAAAAAAPDE/uTG8QIzpfR4/s1600/a-hau-diem-trang-thuot-tha-1.jpg' ;
$h ='https://lh5.googleusercontent.com/-lGiFON_RucI/V9Qt731NPlI/AAAAAAAA4sc/q-aLkn40dTQXeKG6K-9S5AtUK08_tVEaQCLcB/s1600/gaixinhxinh.com-bololi-xiuren-1404110816.jpg' ;
$i ='https://lh5.googleusercontent.com/-lsZB1UZwZiM/Wu8-4BNJZ7I/AAAAAAABVp0/qnmYwAb4qiszkiVXZvIkkUdEEqboeFldQCPcBGAYYCw/s1600/gaixinhxinh.com-bololi-xiuren-191210816.jpg';
$k ='https://lh5.googleusercontent.com/-MqKRwwk4meU/Wu8_BPxgYkI/AAAAAAABVp8/Dz_rXMwjA7oFYsm_i2jKPdoQtgxU9Rz1gCPcBGAYYCw/s1600/gaixinhxinh.com-bololi-xiuren-1942110816.jpg';
$permitted_chars = 'abcdefghik';
// Output: 54esmdr0qf
$ranth = substr(str_shuffle($permitted_chars), 0, 1);
 


$tim = array($lay);



$ket = count($tim) + 1;



preg_match_all('/Phần(.+?)\<\/a\>/', $lay, $matches);
$ket = count($matches[0]) + 1;
echo '<pre>';
print_r($matches);

echo '</pre>';


echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://truyenhentai.viwap.com/namon" method="post">
    Tiêu đề:<br />      
    <input name="ten" value="Truyện sex '.$title.' updata '.$ket.' phần"><br />
    Thể loại:<br />  
    <select name="category">  
                    <optgroup label="Giải trí"> 
                                    <option value="2">Truyện 18+</option>
                            </optgroup>
            </select>  
    <br />
    Thumbnail<br />  
      <select name="thumb">  
     <optgroup label="Chuyên Mục">   
                                    <option>'.$$ranth.'</option>
                            </optgroup>          
            </select>  
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">'.$lay.'';




$bv = curl_init();
for ($i= 1; $i <= 1 ; $i++) { 
curl_setopt ($bv, CURLOPT_URL, 'http://hentailx.com/doc-truyen/'.$vll.'-chapter-'.$i.'.html');
curl_setopt ($bv, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($bv, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$bai = curl_exec($bv);
$bai = explode('<div class="ndtruyen">',$bai);
$bai = explode('<center><div class="phantrang">',$bai[1]);
$bai = trim($bai[0]);
$bai = strip_tags($bai,'<p>,<b>,<center>');
$bai = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is','[img]$2[/img]
',$bai);
$bai = preg_replace('/TruyenTv.net|truyentv.net/i', 'TruyenHentai.Viwap.Com', $bai);
$bai = str_replace('</p>','[/p]',$bai);
$bai = str_replace('<p>','[p]',$bai);
$bai = str_replace('</b>','[/b]',$bai);
$bai = str_replace('<b>','[b]',$bai);
$bai = str_replace('</center>','[/center]',$bai);
$bai = str_replace('<center>','[center]',$bai);




echo '  [br][b]Phần '.$i.'[/b]'.$bai.'  ';
}
curl_close($bv);





   echo '</textarea>
    <br />
    <div class="listm">tag <input type="text" name="tag" value="'.$title.','.$key.', truyen sex, co giao ,truyen hentai, truyen loan luan, truyen nguoi lon, hentai dam, hentai tai mau, full color, anime sex" ></div>
<div class="list"><input type="checkbox" name="comment" value="1" checked> Cho phép bình luận</div>
  <div class="list"><input type="checkbox" name="phantrang" value="1" checked> Cho phép Phân Trang</div>
<div class="list"><center><button type="submit" class="btn btn-primary btn-block">Đăng bài</button></form></center></div>
</div> '; 



}

?>
