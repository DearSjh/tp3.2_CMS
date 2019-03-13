<?php 

//引入公共方法
include './Common/common.php';

/**
 +----------------------------------------------------------
 * 左侧公共导航（常规操作）
 +----------------------------------------------------------
 * @param array 
 +----------------------------------------------------------
 */
function admin_left_nav() {
	$admin_left_nav = M('admin_nav')->where('nav_type=1 and is_show = 1')->order('sort asc')->select();
	return $admin_left_nav;
}

/**
 +----------------------------------------------------------
 * 头部公共导航
 +----------------------------------------------------------
 * @param array
 +----------------------------------------------------------
 */
function admin_top_nav() {
	$admin_top_nav = M('admin_nav')->where('nav_type=2 and is_show = 1')->order('sort asc')->select();
	return $admin_top_nav;
}


/**
 +----------------------------------------------------------
 * 功能：显示表单控件
 * seven.auto 9+guyongbing.icn
 +----------------------------------------------------------
 * @param  int   	 $type     	   表单类型
 * @param  string    $name       字段名称
 * @param  string    $value      表单默认值
 * @param  text      $option     表单多选值
 * @param  string    $css      	   表单样式
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function show_field($type,$name,$value="",$option="",$css=""){
	switch($type){
		case 0: //单行文本
			echo "<input type='text' class='input' name='$name' value='$value' ".remove_str_other($css)." />";
			break;
		case 1: //多行文本不支持编辑器
			if(!empty($css)){
				echo "<textarea class='input' name='$name' ".remove_str_other($css)." >". $value ."</textarea>";
			}else{
				echo "<textarea class='input' name='$name' style='height: 60px; width: 600px;' >". $value ."</textarea>";
			}
			break;
		case 2://百度编辑器
			echo "<script type='text/javascript'>UE.getEditor('c_{$name}')</script><textarea id='c_{$name}' name='{$name}' style='height: 300px; width:80%;'>". $value ."</textarea>";
			break;
		case 3://单选下拉列表
			if($option != ''){
				echo "<select name='$name' ".remove_str_other($css).">";
				if(eregi("<php>(.*)</php>", $option, $temp)){
					eval($temp[1]);
				}else {
					$arr = explode(",",$option);
					for($i=0; $i<count($arr); $i++){
						$select ='';
						$temp = explode("|",$arr[$i]);
						if(count($temp) == 2){
							if($temp[1] == $value){
								$select = 'selected="selected"';
							}
							echo "<option value=\"".$temp[1]."\" $select>".$temp[0]."</option>";
						}else if(count($temp) == 1){
							if($temp[0] == $value){$select = 'selected="selected"';}
							echo "<option value=\"".$temp[0]."\" $select>".$temp[0]."</option>";
						}
					}
				}
				echo "</select>";
			}
			break;
		case 4://单选按钮
			if($option != ''){
				$arr = explode(",",$option);
				for($i=0;$i<count($arr);$i++){
					$select ='';
					$temp = explode("|",$arr[$i]);
					if(count($temp) == 2){
						if($temp[1] == $value){$select = 'checked="checked"';}
						echo "<input name='$name' type='radio' value=\"".$temp[1]."\" $select />".$temp[0]."&nbsp;<span ".remove_str_other($css)."></span>";
					}else if(
							count($temp) == 1){
						if($temp[0] == $value){$select = 'checked="checked"';}
						echo "<input '$name' type='radio' value=\"".$temp[0]."\" $select />".$temp[0]."&nbsp;<span ".remove_str_other($css)."></span>";
					}
				}
			}
			break;
		case 5://多选列表   -- 多个默认值用逗号隔开
			if($option != ''){
				echo "<select name='{$name}[]' size='4' multiple='multiple' ".remove_str_other($css).">";
				if(eregi("<php>(.*)</php>", $option, $temp)){
					eval($temp[1]);
				}else {
					$arr = explode(",",$option);
					$value_arr = explode(",",$value);
					for($i=0;$i<count($arr);$i++){
						$select ='';
						$temp = explode("|",$arr[$i]);
						if(count($temp) == 2){
							if(in_array($temp[1],$value_arr)){$select = 'selected="selected"';}
							echo "<option value='".$temp[1]."' $select>".$temp[0]."</option>";
						}else if(count($temp) == 1){
							if(in_array($temp[0],$value_arr)){$select = 'selected="selected"';}
							echo "<option value='".$temp[0]."' $select>".$temp[0]."</option>";
						}
					}
				}
				echo "</select>";
			}
			break;
		case 6://多选按钮checkbox -- 多个默认值用逗号隔开
			if($option != ''){
				$arr = explode(",",$option);
				$value_arr = explode(",",$value);
				for($i=0;$i<count($arr);$i++){
					$select ='';
					$temp = explode("|",$arr[$i]);
					if(count($temp) == 2){
						if(in_array($temp[1],$value_arr)){$select = 'checked="checked"';}
						echo "<input name='{$name}[]' type='checkbox' value='".$temp[1]."' $select />".$temp[0]."&nbsp;<span ".remove_str_other($css)."></span>";
					}else if(count($temp) == 1){
						if(in_array($temp[0],$value_arr)){$select = 'checked="checked"';}
						echo "<input name='{$name}[]' type='checkbox' value='".$temp[0]."' $select />".$temp[0]."&nbsp;<span ".remove_str_other($css)."></span>";
					}
				}
			}
			break;
		case 7://文件上传  -- 暂未开发
			echo "<script type='text/javascript'>";
			echo "KindEditor.ready(function(K) {";
			echo "				K.create();";
			echo "				var editor = K.editor({";
			echo "					allowFileManager : true,";
			echo "					uploadJson : '__ROOT__/public/editors/kindeditor/php/upload_json.php',";
			echo "					fileManagerJson:'__ROOT__/public/editors/kindeditor/php/file_manager_json.php'";
			echo "				});";
			echo "K('#{$name}').click(function() {";
			echo "	editor.loadPlugin('image', function() {";
echo "		editor.plugin.imageDialog({";
echo "			imageUrl : K('#{$name}_val').val(),";
echo "			clickFn : function(url, title, width, height, border, align) {";
echo "				K('#{$name}_val').val(url);";
echo "				$('#{$name}').css('background-image','url('+url+')').css('background-size','220px 160px');";
echo "				editor.hideDialog();";
echo "			}";
echo "		});";
echo "	});";
echo "});";
echo "});";
echo "</script>";
echo "<div class='instructions del_image'>删除</div>";
echo "<div class='droparea spot' id='{$name}' style='background-image: url({$value}); cursor:pointer;background-size: 220px 160px;'>";
echo "<input type='hidden' name='$name' id='{$name}_val' value='{$value}'>";
echo "</div>";
break;
}
}

/**
 +----------------------------------------------------------
 * 功能：站点配置动态显示
 * seven.auto 
 +----------------------------------------------------------
 * @param  int   	 $type     	   表单类型
 * @param  string    $name       字段名称
 * @param  string    $value      表单默认值
 * @param  text      $option     表单多选值
 * @param  string    $css      	   表单样式
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function site_conf_show_field($type,$name,$value="",$option="",$css=""){
	switch($type){
		case 0: //单行文本
			echo "<input type='text' class='input' name='$name' value='".get_conf($name)."' ".remove_str_other($css)." />";
			break;
		case 1: //多行文本不支持编辑器
			if(!empty($css)){
				echo "<textarea class='input' name='$name' ".remove_str_other($css)." >".get_conf($name)."</textarea>";
			}else{
				echo "<textarea class='input' name='$name' style='height: 60px; width: 600px;' >".get_conf($name)."</textarea>";
			}
			break;
	}
}