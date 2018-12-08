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
    //echo getXvideo($url);
  
}
?>
<style>
body{height:100%;margin:0;overflow:hidden;position:absolute;width:100%}
video{min-height:100%;min-width:100%;position:absolute}
.jw-logo {width:150px!important;height:150px!important;margin:15px!important}
.jw-skin-glow .jw-background-color{background:rgba(222, 56, 87, 0.4) !important}

@media only screen and (max-width:1440px) {
.jw-logo {width:90px!important;height:90px!important;margin:10px!important}
}
@media only screen and (max-width:1000px) {
.jw-logo {width:70px!important;height:70px!important;margin:5px!important}
}
@media only screen and (max-width:500px) {
.jw-logo {width:50px!important;height:50px!important}
.loop-actions .orderby{display:none;}
}


</style>

<script src="/jwplayer.js"></script>
<script>jwplayer.key="MBvrieqNdmVL4jV0x6LPJ0wKB/Nbz2Qq/lqm3g==";</script>

<script src="http://animehay.tv/themes/AH_1.2/all/js/init.js?v=8.0.9"></script>

<div id='player'></div>
<script type='text/javascript'>
jwplayer('player').setup({
file: '<?php
echo json_decode(getXvideo($url))->mp4high;
?>',
image: "https://i.imgur.com/p5S07MQ.jpg?1",
width: "100%",
height: "100%",
aspectratio: "16:9",
primary: "html5",

skin: 'five',
logo: {
file: "https://i.imgur.com/MmI5H39.png",
link: 'http://Cuocsong.viwap.com',
abouttext:"Cuocsong.viwap.com",aboutlink:"http://www.cuocsong.viwap.com",
}
});
</script>

