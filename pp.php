
<?php
$url = $_GET['url']; ///Trang cần leech
$contents = file_get_contents($url);
//$link240 = explode("240: '",$contents);
//$link240q = explode("',",$link240[1]);
//$link480 = explode("480: '",$contents);
//$link480q = explode("',",$link480[1]);
$linkvideo = explode('720","videoUrl":"',$contents);
$linkvideoq = explode('"},',$linkvideo[1]);
//$l240 = $link240q[0];
//$l480 = $link480q[0];
$link = $linkvideoq[0];
$link =  str_replace('&','@',$link);
$link =  str_replace('\','',$link);
// show link ra
//echo '240 : '.$l240.'<br/>';
//echo '480 : '.$l480.'<br/>';
echo '720 : '.$link.'<br/>';
?>
