<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>后台管理首页</title>
    	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/layout.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/common.css" />
<script type="text/javascript" src="__ROOT__/public/style/common/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/base.js"></script>
<!-- tips -->
<link rel="stylesheet" type="text/css" href="__ROOT__/public/style/common/tips/asyncbox/skins/default.css" />
<script type="text/javascript" src="__ROOT__/public/style/common/tips/functions.js"></script>
<script type="text/javascript" src="__ROOT__/public/style/common/tips/jquery.form.js"></script>
<script type="text/javascript" src="__ROOT__/public/style/common/tips/jquery.lazyload.js"></script>
<script type="text/javascript" src="__ROOT__/public/style/common/tips/asyncbox/asyncbox.js"></script>

    </head>
    <body>
        <div class="wrap">
            <!-- 公共头部 start -->
			<div id="Top">
	<div class="logo"><a href=""><img src="__PUBLIC__/img/logo.png" style="border: 0" /></a></div>
	<div class="help"><a href="">后台地图</a><span><a href="http://9kd.sk-skschool.com" target="_blank">关于</a></span></div>
	<div class="menu">
		<ul> 
			<li <?php if(MODULE_NAME == 'Index'): ?>class="fisrt_current"<?php else: ?>class="fisrt"<?php endif; ?>>
				<span><a href="<?php echo U('Jkd/Index/index');?>" >管理首页</a></span>
			</li>
			<li <?php if(MODULE_NAME == 'Global'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Jkd/Global/site_conf');?>">全局管理</a></span>
			</li>
			<li <?php if(MODULE_NAME == 'Menu'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Jkd/Menu/menu_list');?>">栏目管理</a></span>
			</li>
			<!-- 循环头部导航 -->
			<?php $admin_top_nav_list = admin_top_nav(); $now_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
			<?php if(is_array($admin_top_nav_list)): foreach($admin_top_nav_list as $key=>$jkd): ?><li  <?php if($now_url == $jkd['nav_url']): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo ($jkd["nav_url"]); ?>"><?php echo ($jkd["nav_name"]); ?></a></span>
			</li><?php endforeach; endif; ?>
			<li <?php if(MODULE_NAME == 'Dev' or MODULE_NAME == 'ArticleContentModel' or MODULE_NAME == 'ProductContentModel' or MODULE_NAME == 'PageContentModel'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Jkd/Dev/contentModel');?>">开发者模式</a></span>
			</li>
			<li <?php if(MODULE_NAME == 'WebSite'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Jkd/WebSite/ad_list');?>">网站功能</a></span>
			</li>
			<li <?php if(MODULE_NAME == 'TplCenter'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Jkd/TplCenter/index');?>">模板管理</a></span>
			</li>
			<li <?php if(MODULE_NAME == 'Database'): ?>class="end_current"<?php else: ?>class="end"<?php endif; ?>>
				<span><a href="<?php echo U('Jkd/Database/database_list');?>">数据管理</a></span>
			</li> 
		</ul>
	</div>
</div>
<div id="Tags">
	<div class="userPhoto"><img src="__PUBLIC__/img/userPhoto.png" /> </div>
	<div class="navArea">
		<div class="userInfo"><div><a href="<?php echo U('Jkd/Global/site_conf');?>" class="sysSet"><span>&nbsp;</span>系统设置</a> <a href="<?php echo U('Jkd/Common/loginOut');?>" class="loginOut"><span>&nbsp;</span>退出系统</a></div>欢迎您，<?php echo $_SESSION['jkd_uname'] ?>&nbsp;|&nbsp; <a target="_blank" href="<?php echo C('site_url');?>" class='site_index'>网站首页</a></div>
		<div class="nav"><font id="today"></font>您的位置：</div>
	</div>
</div>
<div class="clear"></div>
            <!-- 公共头部 end -->
            <div class="mainBody">
				<!-- 公告左侧 start -->
				<div id="Left">
	<div id="control" class=""></div>
	<div class="subMenuList">
		<div class="itemTitle">
			<?php if(MODULE_NAME == 'Index'): ?>常用操作<?php else: ?>子菜单<?php endif; ?>
		</div>
		<ul>
			<?php if(MODULE_NAME == 'Index'): ?><!-- 管理首页 start -->
				<?php $admin_left_nav_list = admin_left_nav(); ?>
				<?php if(is_array($admin_left_nav_list)): foreach($admin_left_nav_list as $key=>$jkd): ?><li><a href="<?php echo ($jkd["nav_url"]); ?>"><?php echo ($jkd["nav_name"]); ?></a></li><?php endforeach; endif; ?>
				<!-- 管理首页 end -->
			<?php elseif(MODULE_NAME == 'Global'): ?>			
				<!-- 全局管理 start -->	
				<li><a href="<?php echo U('Jkd/Global/site_conf');?>" <?php if(ACTION_NAME == 'site_conf'): ?>class='current'<?php endif; ?>>站点配置</a></li>
				<!-- 全局管理 end -->
			<?php elseif(MODULE_NAME == 'Menu'): ?>			
				<!-- 栏目管理 start -->	
				<li><a href="<?php echo U('Jkd/Menu/menu_list');?>" <?php if(ACTION_NAME == 'menu_list'): ?>class='current'<?php endif; ?>>栏目列表</a></li>
				<!-- 栏目管理 end -->
			<?php elseif(MODULE_NAME == 'Dev' or MODULE_NAME == 'ArticleContentModel' or MODULE_NAME == 'ProductContentModel' or MODULE_NAME == 'PageContentModel'): ?>			
				<!-- 开发者模式 start -->	
				<li><a href="<?php echo U('Jkd/Dev/contentModel');?>" <?php if(ACTION_NAME == 'contentModel' or MODULE_NAME == 'ArticleContentModel' or MODULE_NAME == 'ProductContentModel' or MODULE_NAME == 'PageContentModel'): ?>class='current'<?php endif; ?>>内容模型管理</a></li>
				<li><a href="<?php echo U('Jkd/Dev/admin_nav');?>" <?php if(ACTION_NAME == 'admin_nav' or ACTION_NAME == 'admin_nav_list'): ?>class='current'<?php endif; ?>>后台导航管理</a></li>
				<!-- 开发者模式 end -->
			<?php elseif(MODULE_NAME == 'WebSite'): ?>	
				<!-- 网站功能 start -->
				<li><a href="<?php echo U('Jkd/WebSite/banner_list');?>" <?php if(ACTION_NAME == 'banner_list'): ?>class='current'<?php endif; ?>>轮播管理</a></li>
				<li><a href="<?php echo U('Jkd/WebSite/ad_list');?>" <?php if(ACTION_NAME == 'ad_list'): ?>class='current'<?php endif; ?>>广告管理</a></li>
				<li><a href="<?php echo U('Jkd/WebSite/tag_list');?>" <?php if(ACTION_NAME == 'tag_list'): ?>class='current'<?php endif; ?>>标签管理</a></li>
				<li><a href="<?php echo U('Jkd/WebSite/file_manage');?>" <?php if(ACTION_NAME == 'file_manage'): ?>class='current'<?php endif; ?>>附件管理</a></li> 
				<li><a href="<?php echo U('Jkd/WebSite/friend_link');?>" <?php if(ACTION_NAME == 'friend_link'): ?>class='current'<?php endif; ?>>友情链接</a></li>
				<li><a href="<?php echo U('Jkd/WebSite/message');?>" <?php if(ACTION_NAME == 'message'): ?>class='current'<?php endif; ?>>留言信息</a></li>
				<!-- 网站功能 end -->
			<?php elseif(MODULE_NAME == 'TplCenter'): ?>	
				<!-- 模板管理 start -->
				<li><a href="<?php echo U('Jkd/TplCenter/index');?>" <?php if(MODULE_NAME == 'TplCenter'): ?>class='current'<?php endif; ?>>模板列表</a></li>
				<!-- 模板管理 end -->
			<?php elseif(MODULE_NAME == 'Database'): ?>	
				<!-- 数据管理 start -->
				<li><a href="<?php echo U('Jkd/Database/database_list');?>" <?php if(ACTION_NAME == 'database_list'): ?>class='current'<?php endif; ?>>数据库备份</a></li>
				<!-- 数据管理 end --><?php endif; ?>
		</ul>
	</div>
</div>
				<!-- 公告左侧 end -->
                <div id="Right">
                    <div class="contentArea">
	                    <div class="Item hr">
	                        <div class="current">添加扩展字段</div>
	                    </div>
	                    <form action="" method="post">
	                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
	                            <tr>
	                                <th width="120">字段类型：</th>
	                                <td>
										<select id="field_type" name="field_type" style="width:258px" onChange="if(this.value>2 && this.value <7){ $('#set_option').show();$('#zy_php').hide();  } else{ $('#set_option').hide();$('#zy_php').show(); }">
											<option value="">请选择</option>
											<?php if(is_array($list_type)): $k = 0; $__LIST__ = $list_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k-1); ?>" <?php if($site_conf_extend_fields_info['field_type'] == ($k - 1)): ?>selected='selected'<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>					
									</td>
	                            	<td>
	                            		<span class='jkd_introduce'><a href='javascript:void(0);' id='shuoming'>说明</a></span>
	                            	</td>
	                            </tr>
	                            <tr>
	                                <th width="120">表单显示文本：</th>
	                                <td><input name="form_explain" type="text" class="input" size="40" value="<?php echo ($site_conf_extend_fields_info["form_explain"]); ?>" /></td>
	                            	<td><span class='jkd_introduce'>例如:姓名</span></td>
	                            </tr>
	                            <tr>
	                                <th width="120">字段名称：</th>
	                                <td><input name="field_name" id='field_name' type="text" class="input" size="40" value="<?php echo ($site_conf_extend_fields_info["field_name"]); ?>" /></td>
	                            	<td><span class='jkd_introduce'>例如:name（注：英文）</span></td>
	                            </tr>
	                            <tr id="set_option" <?php if($site_conf_extend_fields_info['field_type'] == 3 or $site_conf_extend_fields_info['field_type'] == 4 or $site_conf_extend_fields_info['field_type'] == 5 or $site_conf_extend_fields_info['field_type'] == 6): else: ?>style="display:none;"<?php endif; ?>>
								  <th width="120">预设选项</th>
								  <td width='258'><textarea name="set_option" style="width:258px; height:115px;"><?php echo ($site_conf_extend_fields_info["set_option"]); ?></textarea></td>
								  <td><span class='jkd_introduce'>多个选项之间用<font color='red'>(,)</font>逗号，每个选项以|分隔 <font color='red'>显示文本|值 </font><br>如果显示文本等于值就直接 写显示文本<br>例如:<br>张三|3,李四|4 </span></td>
								</tr>
	                            <tr style='display:none;'>
	                                <th>预设默认值：</th>
	                                <td width="258"><input class="input" name="default_option" type="text" size="40" value="<?php echo ($site_conf_extend_fields_info["default_option"]); ?>" /></td>
	                            	<td><span class='jkd_introduce'>例如:name字段默认值：李刚 默认可以为空</span></td>
	                            </tr>
	                            <tr>
	                                <th>附加CSS：</th>
	                                <td width="258">
	                                	<textarea name="css" cols="40" rows="2" style="height:85px;"><?php echo remove_str_other($site_conf_extend_fields_info['css']);?></textarea>
	                                </td>
	                           	 	<td><span class='jkd_introduce'>例如：style='width:350px; height:30px'class='red'</span></td>
	                            </tr>
	                            <tr>
	                                <th>排序：</th>
	                                <td><input class="input" name="sort" type="text" size="40" value="<?php echo ($site_conf_extend_fields_info["sort"]); ?>" /></td>
	                            	<td></td>
	                            </tr>
	                            <tr>
	                                <th>状态：</th>
	                                <td>
										<select name="is_show" >
											<option value="1" <?php if(!empty($id) and $site_conf_extend_fields_info['is_show'] == 1): ?>selected='selected'<?php endif; ?>>显示</option>
											<option value="0" <?php if(!empty($id) and $site_conf_extend_fields_info['is_show'] == 0): ?>selected='selected'<?php endif; ?>>隐藏</option>
										</select>		
									</td>
	                            	<td></td>
	                            </tr>
	                        </table>
	                        <input type='hidden' name="id" value="<?php echo ($id); ?>" />
	                    </form>
	                    <div class="commonBtnArea" >
	                        <button class="btn submit">提交</button>
	                    </div>
	                </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!-- 公告底部 -->
        <script type="text/javascript">
	$(window).resize(autoSize);
	$(function(){
		autoSize();
		$(".loginOut").click(function(){
			var url = $(this).attr("href");
			popup.confirm('你确定要退出吗？','你确定要退出吗',function(action){
				if(action == 'ok'){ window.location = url; }
			});
			return false;
		});

		var time=self.setInterval(function(){$("#today").html(date("Y-m-d H:i:s"));},1000);
	});
</script>
        <script type="text/javascript">
        $(function(){
        	//字段类型说明
        	$('#shuoming').click(function(){
                popup.warning('<br />0=单行文本(text)__varchar(255)<br />1=多行文本不支持编辑器(textarea)__text<br />');
                return false;
        	});
        	
		    $(".submit").click(function(){
		    	//字段类型
		    	if($('#field_type').val()==''){
                    popup.error('字段类型不能为空，请选择字段类型！');
                    return false;
                }
		    	//字段名
		    	if($('#field_name').val()==''){
                    popup.error('字段名不能为空');
                    return false;
		    	}
		        commonAjaxSubmit();
		    });
        });
		</script>
    </body>
</html>