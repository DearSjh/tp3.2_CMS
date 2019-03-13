<?php

$arr = array(

	'URL_MODEL'=>3,
		
	'TMPL_PARSE_STRING' => array( //后台公共样式路径
    	'__PUBLIC__' => __ROOT__ . '/Public/style/admin',
	),
		
	'URL_HTML_SUFFIX'=> '',			 		//伪静态URL设置
	
	'DEFAULT_FILTER' => 'htmlspecialchars', //过滤方法
	
	//自动登录有效时间
	'AUTO_LOGIN_LIFETIME' => time() + 3600 * 24 * 7,
		
	'LOGIN_TO_KEY' => '!@#sd$^5&@#df$%#_$aD%',
		
	//扩展字段类型
	'FIELD_TYPE' => array(0=>'单行文本(text)',1=>'多行文本不支持编辑器(textarea)',2=>'多行文本支持编辑器(htmleditor)',3=>'下拉列表菜单(select)',4=>'单选按钮(radio)',5=>'多选列表(multselect)',6=>'多选按钮(checkbox)',7=>'文件上传(file)'),
	//扩展字段类型
	'FIELD_TYPE_TWO' => array(0=>'单行文本(text)',1=>'多行文本不支持编辑器(textarea)'),
	
	"LOAD_EXT_FILE"=>"file"
);

//合并公共配置文件、当前分组配置文件
return array_merge(include './Conf/config.php', $arr);

?>