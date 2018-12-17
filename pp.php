<?php
$url = 'http://www.youporn.com/watch/13618549/holed-school-girl-jojo-kiss-caught-masturbating-with-anal-toys/'; ///Trang cần leech
$contents = file_get_contents($url);
$link240 = explode("240: '",$contents);
$link240q = explode("',",$link240[1]);
$link480 = explode("480: '",$contents);
$link480q = explode("',",$link480[1]);
$link720 = explode("720: '",$contents);
$link720q = explode("',",$link720[1]);
$l240 = $link240q[0];
$l480 = $link480q[0];
$l720 = $link720q[0];
// show link ra
echo '240 : '.$l240.'<br/>';
echo '480 : '.$l480.'<br/>';
echo '720 : '.$l720.'<br/>';
?>
