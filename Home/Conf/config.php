<?php

$arr = array(
	
	'TMPL_PARSE_STRING' => array( //后台公共样式路径
    	'__PUBLIC__' => __ROOT__ . '/Public/style/home',
	),
		
	'URL_HTML_SUFFIX'=> 'html',			 		//伪静态URL设置
	
	'DEFAULT_FILTER' => 'htmlspecialchars', //过滤方法xss

	'TMPL_FILE_DEPR'=>'_',	 		 //分组模板下面模块和操作的分隔符，默认值为“/”
	'DEFAULT_THEME'=>'default',		 //设置默认的模板主题名
	
);

//合并公共配置文件、当前分组配置文件
return array_merge(include './Conf/config.php', $arr);

?>