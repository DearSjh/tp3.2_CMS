<?php 

/**
 +----------------------------------------------------------
 * 功能：计算文件大小
 +----------------------------------------------------------
 * @param int $bytes
 +----------------------------------------------------------
 * @return string 转换后的字符串
 +----------------------------------------------------------
 */
function byteFormat($bytes) {
	$sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
}

/**
 +----------------------------------------------------------
 * 生成随机字符串
 +----------------------------------------------------------
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function randCode($length = 5, $type = 0) {
	$arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
	if ($type == 0) {
		array_pop($arr);
		$string = implode("", $arr);
	} else if ($type == "-1") {
		$string = implode("", $arr);
	} else {
		$string = $arr[$type];
	}
	$count = strlen($string) - 1;
	for ($i = 0; $i < $length; $i++) {
		$str[$i] = $string[rand(0, $count)];
		$code .= $str[$i];
	}
	return $code;
}



/**
 +----------------------------------------------------------
 * 替换采集等通过url参数传值
 +----------------------------------------------------------*/
function jkd_url_repalce($xmlurl,$order='asc'){
	if($order=='asc'){
		return str_replace(array('|','@','#'),array('/','=','&'),$xmlurl);
	} else {
		return str_replace(array('/','=','&'),array('|','@','#'),$xmlurl);
	}
}

/**
 +----------------------------------------------------------
 * 对查询结果集进行排序
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 +----------------------------------------------------------
 * @return array
 +----------------------------------------------------------
 */
function dir_list_sort_by($list,$field, $sortby='asc'){
	if(is_array($list))
	{
		$refer = $resultSet = array();
		foreach ($list as $i => $data)
		{
			$refer[$i] = &$data[$field];
		}
		switch ($sortby)
		{
			case 'asc': // 正向排序
				asort($refer);
				break;
			case 'desc':// 逆向排序
				arsort($refer);
				break;
			case 'nat': // 自然排序
				natcasesort($refer);
				break;
		}
		foreach ( $refer as $key=> $val)
		{
			$resultSet[] = &$list[$key];
		}
		return $resultSet;
	}
	return false;
}

/**
 +----------------------------------------------------------
 * 字节格式化 把字节数格式为 B K M G T 描述的大小
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function byte_format($size, $dec=2)
{
	$a = array("B", "KB", "MB", "GB", "TB", "PB");
	$pos = 0;
	while ($size >= 1024) {
		$size /= 1024;
		$pos++;
	}
	return round($size,$dec)." ".$a[$pos];
}

// 获取文件夹大小
function getdirsize($dir) {
	$dirlist = opendir($dir);
	while (false !==  ($folderorfile = readdir($dirlist)))
	{
		if($folderorfile != "." && $folderorfile != "..")
		{
			if (is_dir("$dir/$folderorfile"))
			{
				$dirsize += getdirsize("$dir/$folderorfile");
			}
			else
			{
				$dirsize += filesize("$dir/$folderorfile");
			}
		}
	}
	closedir($dirlist);
	return $dirsize;
}


/**
 +----------------------------------------------------------
 * 获取时间颜色:24小时内为红色
 +---------------------------------------------------------*/
function getcolordate($type='Y-m-d H:i:s',$time,$color='red'){
	if((time()-$time)>86400){
		return date($type,$time);
	}
	else
	{
		return '<font color="'.$color.'">'.date($type,$time).'</font>';
	}
}

//获取模板类型名称
function gettplname($filename) {
	switch($filename)
	{
		case 'index.html':
			return '网站首页模板';
			break;
		case 'footer.html':
			return '网站底部模板';
			break;
		case 'head.html':
			return '网站头部模板';
			break;
		case 'search.html':
			return '搜索页模板';
			break;
		case 'article_article.html':
			return '文章模型文章页';
			break;
		case 'article_list.html':
			return '文章模型列表页';
			break;
		case 'guestbook.html':
			return '留言本模板';
			break;
		case 'guestbook_nopl.html':
			return '留言本空白xml';
			break;
		case 'guestbook_pl.html':
			return '留言本xml';
			break;
		case 'pl_pl.html':
			return '评论页xml';
			break;
		case 'pl_nopl.html':
			return '评论页空白xml';
			break;
		case 'guestbook_pl.html':
			return '留言本xml';
			break;
		case 'vote.html':
			return '投票页模板';
			break;
	}
	$f = explode('.',$filename);
	switch($f[1])
	{
		case 'js':
			return 'js脚本文件';
			break;
		case 'php':
			return 'php脚本文件';
			break;
		case 'css':
			return '层叠样式表';
			break;
		case 'jpg':
			return 'jpg图片';
			break;
		case 'gif':
			return 'gif图片';
			break;
		case 'png':
			return 'png图片';
			break;
		case 'zip':
			return 'zip压缩包';
			break;
		case 'rar':
			return 'rar压缩包';
			break;
		case 'html':
			return '模板文件';
			break;
		case 'htm':
			return '网页文件';
			break;
		case 'ico':
			return 'ico图标';
			break;
		case 'wmv':
			return 'wmv视频文件';
			break;
		case 'swf':
			return 'flash文件';
			break;
		case 'wma':
			return 'wma音频文件';
			break;
		case 'mp3':
			return 'mp3音频文件';
			break;
		case 'flv':
			return 'flv视频文件';
			break;
		case 'mp4':
			return 'mp4视频文件';
			break;
		default:
			return '未知文件';
			break;
	}
}

/*-----文件夹与文件操作函数-----*/
//读取文件
function read_file($l1)
{
	return @file_get_contents($l1);
}
//写入文件
function write_file($l1, $l2=''){
	$dir = dirname($l1);
	if(!is_dir($dir)){
		mkdirss($dir);
	}
	return @file_put_contents($l1, $l2);
}
//测试写入文件
function testwrite($d){
	$tfile = '_jkd.txt';
	$d = ereg_replace('/$','',$d);
	$fp = @fopen($d.'/'.$tfile,'w');
	if(!$fp){
		return false;
	}else{
		fclose($fp);
		$rs = @unlink($d.'/'.$tfile);
		if($rs){
			return true;
		}else{
			return false;
		}
	}
}
//递归创建文件
function mkdirss($dirs,$mode=0777) {
	if(!is_dir($dirs)){
		mkdirss(dirname($dirs), $mode);
		return @mkdir($dirs, $mode);
	}
	return true;
}


