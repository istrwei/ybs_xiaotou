<?php
/*
 * 首页
 * BY yunbosou.com
 *交流QQ群  172226108
 *
 */
//报错
error_reporting(0);
//超时
set_time_limit(0);
//取消内存限制
ini_set("memory_limit",'-1');
//设置为PRC时区
date_default_timezone_set('PRC'); 
//开始
//引入配置文件
require('config.php');
require('function.php');
$fromurl = 'http://bt.doc5188.com';
$indexhtml = 'index.cache.html';
if(file_exists($indexhtml)){
	$filetime = filemtime($indexhtml);
	$nowtime = time();
	if(($nowtime - $filetime) > $config['cachetime']){
		$content = get_html($fromurl, $config);
		echo $content;
		write_html($content, $indexhtml);
	}else{
		$content = file_get_contents($indexhtml);
		exit($content);
	}
}else{
	$content = get_html($fromurl, $config);
	echo $content;
	write_html($content, $indexhtml);

}

function get_html($siteurl, $config){
	$str = get_url_contents($siteurl);
	$str = str_replace('http://bt.doc5188.com', $config['siteurl'], $str);
	$str = str_replace('优搜磁力搜索', $config['title'], $str);
	$str = str_replace('/statics/', $config['erji'].'statics/', $str);
	$str = preg_replace('/<title>([\s\S]*?)<\/title>/i','<title>'.$config['title'].' - 做最全的资源搜索引擎 - 没有搜不到，只有想不到！</title>',$str);
	$str = preg_replace('/<div style="display:none;">([\s\S]*?)<\/div>/i','<div class="foot">友情链接：'.$config['link'].'</div><div style="display:none;">'.$config['tongji'].'</div>',$str);
	$str = str_replace('action="/search"','action="'.$config['erji'].'search.php"',$str);
	return $str;
}
?>
