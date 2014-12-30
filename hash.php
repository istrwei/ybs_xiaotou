<?php
/*
 * 磁力详情页
 * BY www.yunbosou.com
 * 交流QQ群  172226108
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
require('config.php');
require('function.php');
$hash = htmlspecialchars($_GET['hash']);
if(!$hash){
	header("Location: ".$config['siteurl']."");
}
$ismagnet = preg_match("/^([A-Fa-f0-9]{40})$/",$hash,$hashmatch);
if(!$ismagnet){
	header("Location: ".$config['siteurl']."");
}
$siteurl = 'http://bt.doc5188.com/infohash/'.$hash;
$str = get_url_contents($siteurl);
$str = str_replace('bt.doc5188.com', $config['siteurl'],$str);
$str = str_replace('Bt.Uoso.Net',$config['siteurl'],$str);
$str = str_replace('优搜磁力搜索', $config['title'],$str);
$str = str_replace('/statics/', $config['erji'].'statics/', $str);
$str = preg_replace('/<script charset="gbk"([\s\S]*?)<\/script>/i','',$str);
$str = preg_replace('/<div style="display:none;">([\s\S]*?)<\/div>/i','<div style="display:none;">'.$config['tongji'].'</div>',$str);
$str = str_replace('action="/search"','action="'.$config['erji'].'search.php"',$str);

echo $str;
?>
