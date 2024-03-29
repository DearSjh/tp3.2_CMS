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

    	 <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/img_about.css" />
        <!-- kindeditor -->
        <script src="__ROOT__/public/editors/kindeditor/kindeditor.js"></script>
		<script src="__ROOT__/public/editors/kindeditor/lang/zh_CN.js"></script>
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
				<li><a href="<?php echo U('Jkd/WebSite/banner_list');?>" <?php if(ACTION_NAME == 'banner_list' or ACTION_NAME == 'banner_add' or ACTION_NAME == 'banner_menu'): ?>class='current'<?php endif; ?>>轮播管理</a></li>
				<li><a href="<?php echo U('Jkd/WebSite/ad_list');?>" <?php if(ACTION_NAME == 'ad_list' or ACTION_NAME == 'ad_add'): ?>class='current'<?php endif; ?>>广告管理</a></li>
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
                    <div class="Item">
                        <div class="current">添加编辑新闻</div>
                    </div>
                    <form action='' method='post'>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                        	
                            <tr>
                                <th width="100">广告说明：</th>
                                <td><input id="title" type="text" class="input" size="30" name="info[explain]" value="<?php echo ($ad_info["ad_explain"]); ?>"/></td>
                            </tr>
                            <tr>
                                <th>广告图片地址：</th>
                                <td>
                                	<div class="instructions del_image">删除</div>
                                    <div class="droparea spot" id="ad_img" style="background-image: url(<?php echo ($ad_info["ad_img_src"]); ?>); cursor:pointer;background-size: 220px 160px;">
	                                    <input type="hidden" name="info[ad_img_src]" id="ad_img_val" value="<?php echo ($ad_info["ad_img_src"]); ?>">
                                    </div>
                            	</td>
                            </tr>
                            <tr>
                                <th>alt属性：</th>
                                <td><input type="text" class="input" size="20" name="info[ad_img_alt]" value="<?php echo ($ad_info["ad_img_alt"]); ?>"/> （seo优化）</td>
                            </tr>
                            <tr>
                                <th>广告(宽)：</th>
                                <td><input type="text" class="input" size="20" name="info[ad_img_width]" value="<?php echo ($ad_info["ad_img_width"]); ?>"/></td>
                            </tr>
                            <tr>
                                <th>广告(高)：</th>
                                <td><input type="text" class="input" size="20" name="info[ad_img_height]" value="<?php echo ($ad_info["ad_img_height"]); ?>"/></td>
                            </tr>
                            <tr>
                                <th>排序：</th>
                                <td><input type="text" class="input" size="5" name="info[sort]" value="<?php echo ($ad_info["sort"]); ?>" /></td>
                            </tr>
                            <tr>
                                <th>跳转地址：</th>
                                <td><input type="text" class="input" size="70" name="info[ad_url]" value="<?php echo ($ad_info["ad_url"]); ?>"/></td>
                            </tr>
                            <tr>
                                <th>点击量：</th>
                                <td><input type="text" class="input" size="5" name="info[click]" value="<?php echo ($ad_info["click"]); ?>" id='jkd_random_val'/>&nbsp;&nbsp;&nbsp;<input type='button' value='随机' id='jkd_random' style='min-width:50px;' class="btn"></td>
                            </tr>
                            <?php if(!empty($id)): ?><input type='hidden' value="<?php echo ($id); ?>" name='id' /><?php endif; ?>
                        </table>
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
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
                $(".submit").click(function(){
                    if($('#title').val()==''){
                        popup.error('广告说明不能为空！');
                        return false;
                    }
                    commonAjaxSubmit("");
                    return false;
                });
                //随机点击量
                $("#jkd_random").click(function(){
                	var other_val =  Math.floor(Math.random()*1000);
                    $('#jkd_random_val').val(other_val);
                }); 
                //删除图片  123
                $(".del_image").click(function(){
                	$(this).siblings('.spot').css('background-image','');
                	$(this).siblings('.spot').children('input').val('');
               	}); 
            });
        </script>
		<script type='text/javascript'>	
		KindEditor.ready(function(K) {
	          K.create();
	          var editor = K.editor({
	              allowFileManager : true,
	              uploadJson : '__ROOT__/public/editors/kindeditor/php/upload_json.php?dirname=ad',
	              fileManagerJson:'__ROOT__/public/editors/kindeditor/php/file_manager_json.php?dirname=ad'
	              //sdl:false
	          });
	          K('#ad_img').click(function() {
	              editor.loadPlugin('image', function() {
	                  editor.plugin.imageDialog({
	                      imageUrl : K('#ad_img_val').val(),
	                      clickFn : function(url, title, width, height, border, align) {
	                          K('#ad_img_val').val(url);
                              $('#ad_img').css('background-image','url('+url+')').css('background-size','220px 160px');
	                          editor.hideDialog();
	                      }
	                  });
	              });
	          });
	      });
		</script>
    </body>
</html>