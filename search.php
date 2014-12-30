<?php
/*
 * 搜索页
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
//引入配置文件
require('config.php');
require('function.php');
$s = htmlspecialchars($_GET['s']);
if(!$s){
	header("Location: ".$config['siteurl']."");
}
$p = @htmlspecialchars($_GET['p']);
if($p){
	$p = '&p='.intval($p);
}
$siteurl = 'http://bt.doc5188.com/search?word='.urlencode($s).$p;

$str = get_url_contents($siteurl);
$str = str_replace('bt.doc5188.com', $config['siteurl'],$str);
$str = str_replace('Bt.Uoso.Net',$config['siteurl'],$str);
$str = str_replace('优搜磁力搜索', $config['title'],$str);
$str = str_replace('/statics/', $config['erji'].'statics/', $str);
$str = str_replace('/hash/', $config['erji'].'hash.php?hash=', $str);
$str = preg_replace('/<title>([\s\S]*?)<\/title>/i','<title>'.$s.' - '.$config['title'].' - 做最全的资源搜索引擎 - 没有搜不到，只有想不到！</title>',$str);
$str = preg_replace('/<div style="display:none;">([\s\S]*?)<\/div>/i','<div style="display:none;">'.$config['tongji'].'</div>',$str);
$str = str_replace('action="/search"','action="'.$config['erji'].'search.php"',$str);
$str = str_replace('href="/search?word=','href="'.$config['erji'].'search.php?s=',$str);

echo $str;

?>
