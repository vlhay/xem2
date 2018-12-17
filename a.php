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
	    
	    
if (!isset($_POST['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="post">Url: <input name="url" type="text"><input type="submit" value="Leech" ></form>';
}
else
{

$url = $_POST['url'];
$url =  str_replace('http://m.','',$url);
$url =  str_replace('https://','',$url);
$url =  str_replace($url,'https://'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$title = curl_exec($curl);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = trim($title[0]);




$lay = curl_exec($curl);
$lay = explode('"720","videoUrl":"',$lay);
$lay = explode('"},{"defaultQuality":true,"format":"mp4","quality":"480","videoUrl":"',$lay[1]);
$lay = trim($lay[0]);
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
   
</div> '; 

}

?>
