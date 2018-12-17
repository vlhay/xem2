<?php
$url = 'http://fr.pornhub.com/view_video.php?viewkey=ph5bcc71f8663d3'; ///Trang cần leech
$contents = file_get_contents($url);
echo '240 : '.$contents.'<br/>';
?>
