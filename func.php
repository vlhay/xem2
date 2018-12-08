<?php
// Đếm số kí tự
function duc_count($data,$kt){
$chars=str_split($data);
$count=0;
foreach($chars as &$char)
{
    if($char==$kt)
    {
  $count++;
    }
}
return $count;
}

// Upload file lên imgur.com
function md_up_file($link){
  $client_id="46ecc13f6a05d52"; 
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json'); 
  curl_setopt($curl, CURLOPT_TIMEOUT, 30); 
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id)); 
  curl_setopt($curl, CURLOPT_POST, 1); 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($curl, CURLOPT_POSTFIELDS, array('image' => base64_encode(file_get_contents($link)))); 
  $out = curl_exec($curl); 
  curl_close ($curl); 
  $pms = json_decode($out,true); 
  return $pms['data']['link'];
}
// Upload các hình ảnh có trong bài
function md_up_files($data){
  preg_match_all('/\[img\](.+?)\[\/img\]/is', $data, $imgg);
  foreach($imgg[0] as $i=>$image){
  $img = str_replace('[img]', '',$image);  $img = str_replace('[/img]', '',$img);
  $data=str_replace($image, '[img]'.md_up_file($img).'[/img]', $data);
  }
  return $data;
}


// ip của bạn
function md_ip(){
if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
{
$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
{
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
$ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}

function duc_content($noidung, $start, $stop) {
        $bd = strpos($noidung, $start);
        $kt = strpos(substr($noidung, $bd), $stop) + $bd;
        $content = substr($noidung, $bd, $kt - $bd);
        return $content;
    }
    
function md_trim($html){ 
$html = str_replace(array("\r\n", "\r"), "\n", $html); 
$lines = explode("\n", $html); 
$new_lines = array(); 

foreach ($lines as $i => $line) { 
if(!empty($line)) 
$new_lines[] = trim($line); 
} 
return implode($new_lines); 

}

// Chat ở guestbook
function md_guestbook($link,$nick,$comment){
    include 'set.php';
    @set_time_limit(0);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, $link);
    $nd = curl_exec($ch);
    preg_match('/<input type=\"hidden\" name=\"__xtx\" value=\"(.*?)\" \/>/is', $nd, $info); $__xtx = @$info[1];
    preg_match('/<input type=\"hidden\" name=\"__xtxs\" value=\"(.*?)\" \/>/is', $nd, $info); $__xtxs = @$info[1];
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('__xtx' => $__xtx, '__xtxs' => $__xtxs, '__xtcomments_nick' => $nick, '__xtcomments_msg' => $comment,'submit' => 'Save'));
    curl_exec($ch);
    curl_close($ch);
}
    
function md_get_content($link){
    @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser/file_edit?file='.$link);
    $nd = curl_exec($ch);
    curl_close($ch);    
    return str_replace('<textarea cols="15" rows="15" name="value">','',duc_content($nd,'<textarea cols="15" rows="15" name="value">','</textarea>'));
}

function md_domain(){
    @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/panel');
    $nd = curl_exec($ch);
    curl_close($ch);
    preg_match('/<div class=\"top-header\">(.*?)<b>(.*?)<a href=\"(.*?)\">(.*?)<\/a><\/b>/is', $nd, $info); 
    return $info[4];
}

function md_set_file($link,$content_file){
    @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser');
    $nd = curl_exec($ch);
    preg_match('#token=(.*?)&#is', $nd, $matoken);$token = @$matoken[1];
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser/file_save?__token='.$token.'&amp&act=edit_file&amp&file=%2F'.$link);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('value' => $content_file, 'submit' => 'Save'));
    curl_exec($ch);
    curl_close($ch);
}

function md_set_dir($link,$name_folder){
    @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser');
    $nd = curl_exec($ch);
    preg_match('#token=(.*?)&#is', $nd, $matoken);$token = @$matoken[1];
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser/file_save?__token='.$token.'&act=new_dir&dir=/'.$link);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('value' => $name_folder, 'submit' => 'Ok'));   
    curl_exec($ch);
    curl_close($ch);
}

function md_list_file($link){
     @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser?a=&f=&file=%2F'.$link);
    $nd = curl_exec($ch);
    curl_close($ch);
    $list = get_content($nd,'<div class="odd" >','<div class="list border func">');
    $list = str_replace('<img class="noskip" src="/images/icons/mimes/html.png" alt="&gt;"/>','[html]',$list);
    $list = str_replace('<img class="noskip" src="/images/icons/mimes/text.png" alt="&gt;"/>','[text]',$list);
    $list = str_replace('<img class="noskip" src="/images/icons/folder.png" alt="&gt;"/>','[folder]',$list);
    $list = str_replace('/filebrowser/file_open?file=','edit_file.php?id=',$list);
    $list = str_replace('/filebrowser?a=&amp;f=&amp;file=','?id=',$list);
    //$list = md_trim(strip_tags(str_replace('<div class="odd" >','',$list)));
    return $list;
}

function md_move_file($old_link,$new_link){
    @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser');
    $nd = curl_exec($ch);
    preg_match('#token=(.*?)&#is', $nd, $matoken);$token = @$matoken[1]; 
    curl_setopt($ch, CURLOPT_URL, 'http://sextgem.com/filebrowser/file_save?__token='.$token.'&act=mv&f=%2F'.$old_link.'&value='.$new_link.'%2F');  
    curl_exec($ch);
    curl_close($ch);
}

// Đếm số kí tự
function md_count($data,$kt){
$chars=str_split($data);
$count=0;
foreach($chars as &$char)
{
    if($char==$kt)
    {
  $count++;
    }
}
return $count;
}

    function md_keys_google($value){
    mb_internal_encoding('UTF-8');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'NokiaN73-2/3.0-630.0.2 Series60/3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1');
    curl_setopt($ch, CURLOPT_URL, 'http://www.google.com/search?ie=UTF-8&oe=utf8&q='.$value.'&btnG=Search');
    $nd = curl_exec($ch);
    curl_close($ch);
    preg_match('#<div style="font-size:110%">Related:</div><div style="padding:4px 8px 0">(.*?)</div></div></div><div id="navbar" style="margin:4px 0;text-align:center">#is', $nd, $ab);$info = @$ab[1];
    $info = str_replace('<a',',<a',$info);
    $info =  strip_tags($info);
    return html_entity_decode(substr($info,1,20000));
    }
    
    function md_get_info($link,$kt_a,$kt_b){
    mb_internal_encoding('UTF-8');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'NokiaN73-2/3.0-630.0.2 Series60/3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1');
    curl_setopt($ch, CURLOPT_URL, $link);
    $nd = curl_exec($ch);
    curl_close($ch);
    return str_replace($kt_a,'',duc_content($nd,$kt_a,$kt_b));
    }
    
//Đưa tiêu đề về dạng url
function rwurl($title){
$replacement = '-';
$map = array();
$quotedReplacement = preg_quote($replacement, '/');
$default = array(
'/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
'/e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
'/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
'/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
'/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
'/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/'	=> 'y',
'/đ|Đ/' => 'd',
'/ç/' => 'c',
'/ñ/' => 'n',
'/ä|æ/' => 'ae',
'/ö/' => 'o',
'/ü/' => 'u',
'/Ä/' => 'A',
'/Ü/' => 'U',
'/Ö/' => 'O',
'/ß/' => 'b',
'/̃|̉|̣|̀|́/' => '',
'/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ', '/\\s+/' => $replacement,
sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
);
$title = urldecode($title);
mb_internal_encoding('UTF-8');
$map = array_merge($map, $default);
return strtolower( preg_replace(array_keys($map), array_values($map), $title) );
}   
