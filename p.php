<?php
set_time_limit(0);
error_reporting(0);
function fetch_value($str, $find_start = '', $find_end = '')
{
    if ($find_start == '') {
        return '';
    }
    $start = strpos($str, $find_start);
    if ($start === false) {
        return '';
    }
    $length = strlen($find_start);
    $substr = substr($str, $start + $length);
    if ($find_end == '') {
        return $substr;
    }
    $end = strpos($substr, $find_end);
    if ($end === false) {
        return $substr;
    }
    return substr($substr, 0, $end);
}
function getXvideo($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 4.4.2; en-us; SAMSUNG SM-G900T Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/1.6 Chrome/28.0.1500.94 Mobile Safari/537.36");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    $xx = curl_exec($ch);
    curl_close($ch);
    unset($ch);



    if (fetch_value($xx, "html5player.setVideoUrlHigh('", "');") != "") {
        $result['error']   = 0;
        $result['mp4low']  = fetch_value($xx, "html5player.setVideoUrlLow('", "');");
        $result['mp4high'] = fetch_value($xx, "html5player.setVideoUrlHigh('", "');");
        $result['image']   = fetch_value($xx, "html5player.setThumbUrl('", "');");
        $result['title']   = fetch_value($xx, "html5player.setVideoTitle('", "');");
    } else {
        $result['error'] = 2;
        $result['msg']   = 'Có lỗi xảy ra !! Thử lại sau nhé !';
    }
    return json_encode($result);
}
if (isset($_GET['url']) && strstr($_GET['url'], 'xvideos.com') != null) {
    $url = $_GET['url'];
    $urll=json_decode(getXvideo($url))->mp4high;
    $urll =  str_replace('&','@',$urll);
header('Location: '.$_SERVER["HTTP_REFERER"].'/?url='.$urll.'');
  
}
?><?php
echo json_decode(getXvideo($url))->mp4high;
?>
