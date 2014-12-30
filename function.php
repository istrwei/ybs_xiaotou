<?php
//写入缓存
function write_html($content, $indexhtml){
	if($content){
		$fp = fopen($indexhtml, 'w+');
		if($fp){
			fwrite($fp, $content);
		}else{
			return '网站累了，休息下，请稍后访问！';
		}
		fclose($fp);
	}else{
		return '网站累了(NC)，休息下，请稍后访问！';
	}
}
//获取数据
function get_url_contents($url){
    if (ini_get("allow_url_fopen") == "1"){
		return file_get_contents($url);
	}	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; c8650 Build/GWK74) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1s'); 
    curl_setopt($ch, CURLOPT_URL, $url);
    $result =  curl_exec($ch);
    curl_close($ch);
    return $result;
}
?>