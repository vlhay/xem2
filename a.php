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
$title = curl_exec($curl);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = trim($title[0]);
$title = explode('- Gai xinh -',$title);
$title = trim($title[0]);




$lay = curl_exec($curl);


$lay = explode("<div itemprop='articleBody'>",$lay);
$lay = explode("<i class='fa fa-tag fa-lg'></i>",$lay[1]);


$lay = trim($lay[0]);
$lay = strip_tags($lay,'<img><iframe>');
$thum = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"<option>$2</option>",$lay);
	$lay = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"[img]$2[/img]
	",$lay);
$lay =  str_ireplace('GaiXinhXinh.Com','Top18.ViWap.Com' ,$lay);
$lay = strip_tags($lay,'<img>,<br>');
$lay = trim($lay);
$lay =  str_replace('Tải ảnh','' ,$lay);
$lay = trim($lay);
curl_close($curl);


echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://top18.viwap.com/namon" method="post">
    Tiêu đề:<br />  	
    md_keys_google($value)
    <input name="ten" value="'.$title.'"><br />

    <select name="category">  
		      		<optgroup label="Giải trí">	
				              		<option value="2">Ảnh Girl Xinh</option>
              				</optgroup>
		    </select>  
    <br />
    Thumbnail<br />  
     <select name="thumb">  
		   <optgroup>	
	'.$thum.'
              		 </optgroup>			
		    </select>  
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">'.$lay.'</textarea>
    <br />
    <input type="checkbox" name="comment" value="1" checked> Cho phép bình luận
     <button type="submit" class="btn btn-primary btn-block"id="eow">Đăng bài</button></div>
    </form>  
   

<script language="javascript"> document.getElementById("eow").click(); </script>
</div> '; 

}

?>
