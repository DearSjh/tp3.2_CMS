<?php 

/**
 * -------------------------------------
 * 注释规范
 * @param  [type]  $value [description]
 * @param  integer $type  [description]
 * @return [type]         [description]
 * -------------------------------------
 */

/**
 +----------------------------------------------------------
 * 原样输出print_r的内容
 +----------------------------------------------------------
 * @param string    $content   待print_r的内容
 +----------------------------------------------------------
 */
function p($content) {
	echo "<pre>";
	print_r($content);
	echo "</pre>";
}

/**
 * 获取配置文件信息
 +----------------------------------------------------------
 * @param  [string] $str  [description] 下标
 +----------------------------------------------------------
 * @return [string]  
 +----------------------------------------------------------
 */
function get_conf($str){
	return C($str);
}

/**
 +----------------------------------------------------------
 * 功能：检测一个字符串是否是邮件地址格式
 +----------------------------------------------------------
 * @param string $value    待检测字符串
 +----------------------------------------------------------
 * @return boolean
 +----------------------------------------------------------
 */
function is_email($value) {
	return preg_match("/^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i", $value);
}

/**
 +----------------------------------------------------------
 * 功能：字符串截取指定长度
 * seven.auto 9+guyongbing.icn
 +----------------------------------------------------------
 * @param string    $string      待截取的字符串
 * @param int       $len         截取的长度
 * @param int       $start       从第几个字符开始截取
 * @param boolean   $suffix      是否在截取后的字符串后跟上省略号
 +----------------------------------------------------------
 * @return string               返回截取后的字符串
 +----------------------------------------------------------
 */
function cutStr($str, $len = 100, $start = 0, $suffix = 1) {
	$str = strip_tags(trim(strip_tags($str)));
	$str = str_replace(array("\n", "\t"), "", $str);
	$strlen = mb_strlen($str);
	while ($strlen) {
		$array[] = mb_substr($str, 0, 1, "utf8");
		$str = mb_substr($str, 1, $strlen, "utf8");
		$strlen = mb_strlen($str);
	}
	$end = $len + $start;
	$str = '';
	for ($i = $start; $i < $end; $i++) {
		$str.=$array[$i];
	}
	return count($array) > $len ? ($suffix == 1 ? $str . "&hellip;" : $str) : $str;
}

//让其支持PHP代码
function zy_php_value($v){
	if(eregi("<php>(.*)</php>", $v, $temp)){
		eval($temp[1]);
	}else {
		echo $v;
	}
}

/**
 +----------------------------------------------------------
 * 功能：去除转义字符
 * seven.auto 9+guyongbing.icn
 +----------------------------------------------------------
 * @param  string    $string     待转义的字符串
 +----------------------------------------------------------
 * @return string                返回转义后的字符串
 +----------------------------------------------------------
 */
function remove_str_other($str){
	$str = str_replace("\'" ,"'" ,$str);
	return $str;
}


/**
 * 当前操作名（方法名称）
*/
function get_action_name(){
	return ACTION_NAME;
}

/**
 * 获取ad广告
 * @param  [intval] $id [description] 当前广告id
 * @return [string] $str
 */
function get_ad($id){
	$str_info = M('ad')->where('id='. $id)->find();
	$url_link = $str_info['url_link'];				 //跳转
	$getImgUrl = $str_info['getImgUrl']; 			 //图片地址
	$getImgUrlwidth = $str_info['getImgUrlwidth'];   //广告宽度
	$getImgUrlheight = $str_info['getImgUrlheight']; //广告高度
	//过滤字符串
	$panduan = substr($url_link, 0, 7);
	if($panduan == 'http://'){
		$url_link = substr($url_link,7);
	}
	$str ="<a href='".C('JKD_SITE_URL')."/index.php/Common/ad_click/ad_id/".$str_info['id']."/uri/".$url_link."' target='_blank'><img src='".__ROOT__."/Public/Upload/ad/$getImgUrl' border='1' alt=". $str_info['getImgUrltitle'] ." width='$getImgUrlwidth' height='$getImgUrlheight' /></a>";
	return $str;
}
