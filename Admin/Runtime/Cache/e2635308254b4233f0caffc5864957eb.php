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

    	<!-- 初始化百度编辑器  -->
    	<script type="text/javascript" src="__ROOT__/public/editors/ueditor/ueditor.config.js"></script><script type="text/javascript" src="__ROOT__/public/editors/ueditor/ueditor.all.min.js"></script>
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
	<div class="help"><a href="javascript:void(0);">后台地图</a><span><a href="javascript:void(0);" target="_blank">关于</a></span></div>
	<div class="menu">
		<ul> 
			<li <?php if(MODULE_NAME == 'Index'): ?>class="fisrt_current"<?php else: ?>class="fisrt"<?php endif; ?>>
				<span><a href="<?php echo U('Index/index');?>" >管理首页</a></span>
			</li>
			<li <?php if(MODULE_NAME == 'Global'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Global/site_conf');?>">全局管理</a></span>
			</li>
			<li <?php if(MODULE_NAME == 'Menu'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Menu/menu_list');?>">栏目管理</a></span>
			</li>
			<!-- 循环头部导航 -->
			<?php $admin_top_nav_list = admin_top_nav(); $now_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
			<?php if(is_array($admin_top_nav_list)): foreach($admin_top_nav_list as $key=>$jkd): ?><li  <?php if($now_url == $jkd['nav_url']): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo ($jkd["nav_url"]); ?>"><?php echo ($jkd["nav_name"]); ?></a></span>
			</li><?php endforeach; endif; ?>
			<?php $now_developer_status = get_conf('IS_DEVELOPER'); ?>
			<?php if($now_developer_status == 1): ?><li <?php if(MODULE_NAME == 'Dev' or MODULE_NAME == 'ArticleContentModel' or MODULE_NAME == 'ProductContentModel' or MODULE_NAME == 'PageContentModel'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('Dev/contentModel');?>">开发者模式</a></span>
			</li><?php endif; ?>
			<li <?php if(MODULE_NAME == 'WebSite'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('WebSite/ad_list');?>">网站功能</a></span>
			</li>
			<?php $now_developer_status = get_conf('IS_TPL_MANAGE'); ?>
			<?php if($now_developer_status == 1): ?><li <?php if(MODULE_NAME == 'TplCenter'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('TplCenter/index');?>">模板管理</a></span>
			</li><?php endif; ?>
			<li <?php if(MODULE_NAME == 'Database'): ?>class="end_current"<?php else: ?>class="end"<?php endif; ?>>
				<span><a href="<?php echo U('Database/database_list');?>">数据管理</a></span>
			</li> 
		</ul>
	</div>
</div>
<div id="Tags">
	<div class="userPhoto"><img src="__PUBLIC__/img/userPhoto.png" /> </div>
	<div class="navArea">
		<div class="userInfo"><div><a href="<?php echo U('Global/site_conf');?>" class="sysSet"><span>&nbsp;</span>系统设置</a> <a href="<?php echo U('Common/loginOut');?>" class="loginOut"><span>&nbsp;</span>退出系统</a></div>欢迎您，<?php echo $_SESSION['jkd_uname'] ?>&nbsp;|&nbsp; <a target="_blank" href="<?php echo C('site_url');?>" class='site_index'>网站首页</a></div>
		<div class="nav">
			<font id="today"></font>您的位置：
			<?php if(MODULE_NAME == 'Index'): ?>后台管理 > 管理首页
			<?php elseif(MODULE_NAME == 'Global'): ?>
			后台管理 > 全局管理
			<?php elseif(MODULE_NAME == 'Menu'): ?>
			后台管理 > 栏目管理
			<?php elseif(MODULE_NAME == 'Dev'): ?>
			后台管理 > 开发者模式
			<?php elseif(MODULE_NAME == 'WebSite'): ?>
			后台管理 > 网站功能
			<?php elseif(MODULE_NAME == 'TplCenter'): ?>
			后台管理 > 模板管理
			<?php elseif(MODULE_NAME == 'Database'): ?>
			后台管理 > 数据管理<?php endif; ?>
		</div>
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
				<li><a href="<?php echo U('Global/site_conf');?>" <?php if(ACTION_NAME == 'site_conf'): ?>class='current'<?php endif; ?>>站点配置</a></li>
				<li><a href="<?php echo U('Global/safety_conf');?>" <?php if(ACTION_NAME == 'safety_conf'): ?>class='current'<?php endif; ?>>安全配置</a></li>
				<li><a href="<?php echo U('Global/go_admin');?>" <?php if(ACTION_NAME == 'go_admin'): ?>class='current'<?php endif; ?>>后台入口管理</a></li>
				<li><a href="<?php echo U('Global/system_conf');?>" <?php if(ACTION_NAME == 'system_conf'): ?>class='current'<?php endif; ?>>系统配置</a></li>
				<!-- 全局管理 end -->
			<?php elseif(MODULE_NAME == 'Menu'): ?>			
				<!-- 栏目管理 start -->	
				<li><a href="<?php echo U('Menu/menu_list');?>" <?php if(ACTION_NAME == 'menu_list' or ACTION_NAME == 'menu_edit'): ?>class='current'<?php endif; ?>>栏目列表</a></li>
				<!-- 栏目管理 end -->
			<?php elseif(MODULE_NAME == 'Dev' or MODULE_NAME == 'ArticleContentModel' or MODULE_NAME == 'ProductContentModel' or MODULE_NAME == 'PageContentModel'): ?>			
				<!-- 开发者模式 start -->
				<li><a href="<?php echo U('Dev/contentModel');?>" <?php if(ACTION_NAME == 'contentModel' or MODULE_NAME == 'ArticleContentModel' or MODULE_NAME == 'ProductContentModel' or MODULE_NAME == 'PageContentModel'): ?>class='current'<?php endif; ?>>内容模型管理</a></li>
				<li><a href="<?php echo U('Dev/admin_nav');?>" <?php if(ACTION_NAME == 'admin_nav' or ACTION_NAME == 'admin_nav_list'): ?>class='current'<?php endif; ?>>后台导航管理</a></li>
				<!-- 开发者模式 end -->
			<?php elseif(MODULE_NAME == 'WebSite'): ?>	
				<!-- 网站功能 start -->
				<li><a href="<?php echo U('WebSite/banner_list');?>" <?php if(ACTION_NAME == 'banner_list' or ACTION_NAME == 'banner_add' or ACTION_NAME == 'banner_menu'): ?>class='current'<?php endif; ?>>轮播管理</a></li>
				<li><a href="<?php echo U('WebSite/ad_list');?>" <?php if(ACTION_NAME == 'ad_list' or ACTION_NAME == 'ad_add'): ?>class='current'<?php endif; ?>>广告管理</a></li>
				<li><a href="<?php echo U('WebSite/tag_list');?>" <?php if(ACTION_NAME == 'tag_list' or ACTION_NAME == 'tag_add'): ?>class='current'<?php endif; ?>>标签管理</a></li>
				<li><a href="<?php echo U('WebSite/file_manage');?>" <?php if(ACTION_NAME == 'file_manage'): ?>class='current'<?php endif; ?>>附件管理</a></li> 
				<li><a href="<?php echo U('WebSite/friend_link');?>" <?php if(ACTION_NAME == 'friend_link'): ?>class='current'<?php endif; ?>>友情链接</a></li>
				<li><a href="<?php echo U('WebSite/message');?>" <?php if(ACTION_NAME == 'message'): ?>class='current'<?php endif; ?>>留言信息</a></li>
				<!-- 网站功能 end -->
			<?php elseif(MODULE_NAME == 'TplCenter'): ?>	
				<!-- 模板管理 start -->
				<li><a href="<?php echo U('TplCenter/index');?>" <?php if(MODULE_NAME == 'TplCenter'): ?>class='current'<?php endif; ?>>模板列表</a></li>
				<!-- 模板管理 end -->
			<?php elseif(MODULE_NAME == 'Database'): ?>	
				<!-- 数据管理 start -->
				<li><a href="<?php echo U('Database/database_list');?>" <?php if(ACTION_NAME == 'database_list'): ?>class='current'<?php endif; ?>>数据库备份</a></li>
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
                        	<?php if($show_default_fields_status[0] == 1): ?><tr>
                                <th>语言选择：</th>
                                <td>
                                    <select name="info[lang]">
                                        <option value="zh-cn" <?php if($article_info['lang'] == 'zh-cn'): ?>selected<?php endif; ?> >简体中文</option>
                                        <option value="zh-en" <?php if($article_info['lang'] == 'zh-en'): ?>selected<?php endif; ?> >English</option>
									</select>
                           		</td>
                            </tr><?php endif; ?>
                        	<?php if($show_default_fields_status[1] == 1): ?><tr>
                                <th width="100">文章标题：</th>
                                <td><input id="title" type="text" class="input" size="60" name="info[title]" value="<?php echo ($article_info["title"]); ?>"/></td>
                            </tr><?php endif; ?>
                        	<?php if($show_default_fields_status[2] == 1): ?><tr>
                                <th width="100">文章发布状态：</th>
                                <td>
                                	<label><input type="radio" name="info[status]" value="1" <?php if($article_info["status"] == 1): ?>checked="checked"<?php endif; ?> /> 文章已发布状态</label>
                                    &nbsp;<label><input type="radio" name="info[status]" value="0" <?php if($article_info["status"] == 0): ?>checked="checked"<?php endif; ?> /> 文章审核状态</label>
								</td>
                            </tr><?php endif; ?>
                        	<?php if($show_default_fields_status[3] == 1): ?><tr>
                                <th>文章所属分类：</th>
                                <td>
                                    <select name="info[cid]" class='type_change'>
										<?php if(get_action_name() == 'article_add'): if(is_array($menu_list)): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jkd): $mod = ($i % 2 );++$i; if($jkd['id'] == $cid): ?><option value="<?php echo ($jkd["id"]); ?>" selected="selected"><?php echo ($jkd["menu_name"]); ?></option>
	                                            <?php else: ?>
	                                            <option value="<?php echo ($jkd["id"]); ?>"><?php echo ($jkd["menu_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				                        <?php else: ?>
	                                        <?php if(is_array($menu_list)): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jkd): $mod = ($i % 2 );++$i; if($jkd['id'] == $article_info['cid']): ?><option value="<?php echo ($jkd["id"]); ?>" selected="selected"><?php echo ($jkd["menu_name"]); ?></option>
	                                            <?php else: ?>
	                                            <option value="<?php echo ($jkd["id"]); ?>"><?php echo ($jkd["menu_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </select>
                            	</td>
                            </tr><?php endif; ?>
                            <?php if($show_default_fields_status[4] == 1): ?><tr>
                                <th>文章图片：</th>
                                <td>
                                	<div class="instructions del_image">删除</div>
                                    <div class="droparea spot" id="article_img" style="background-image: url(<?php echo ($article_info["img"]); ?>); cursor:pointer;background-size: 220px 160px;">
	                                    <input type="hidden" name="info[img]" id="article_img_val" value="<?php echo ($article_info["img"]); ?>">
                                    </div>
                            	</td>
                            </tr><?php endif; ?>
                        	<?php if($show_default_fields_status[5] == 1): ?><tr>
                                <th>文章关键词：</th>
                                <td><input type="text" class="input" size="60" name="info[keywords]" value="<?php echo ($article_info["keywords"]); ?>"/> 多关键词间用半角逗号（,）分开，可用于做文章关联阅读条件</td>
                            </tr><?php endif; ?>
                        	<?php if($show_default_fields_status[6] == 1): ?><tr>
                                <th>文章描述：</th>
                                <td><textarea class="input" style="height: 60px; width: 600px;" name="info[description]"><?php echo ($article_info["description"]); ?></textarea> 用于SEO的description</td>
                            </tr><?php endif; ?>
                        	<?php if($show_default_fields_status[7] == 1): ?><tr>
                                <th>文章摘要：</th>
                                <td><textarea class="input" style="height: 60px; width: 600px;" name="info[summary]"><?php echo ($article_info["summary"]); ?></textarea> 如果不填写则系统自动截取文章前200个字符</td>
                            </tr><?php endif; ?>
                        	<?php if($show_default_fields_status[8] == 1): ?><tr>
                                <th>点击量：</th>
                                <td><input type="text" class="input" size="5" name="info[click]" value="<?php echo ($article_info["click"]); ?>" id='jkd_random_val'/>&nbsp;&nbsp;&nbsp;<input type='button' value='随机' id='jkd_random' style='min-width:50px;' class="btn"></td>
                            </tr><?php endif; ?>
                            <!-- 循环文章扩展的字段 start -->
							<?php if(is_array($menu_extend_show_list)): $i = 0; $__LIST__ = $menu_extend_show_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jkd): $mod = ($i % 2 );++$i;?><tr>
							  <th><?php echo ($jkd["form_explain"]); ?>：</th>
							  <td>
								  <?php if(get_action_name() == 'article_edit'): echo show_field($jkd["field_type"],$jkd["field_name"],$article_info[$jkd["field_name"]],$jkd["set_option"],$jkd["css"]);?>
								  <?php else: ?>
								  <?php echo show_field($jkd["field_type"],$jkd["field_name"],$jkd["default_option"],$jkd["set_option"],$jkd["css"]); endif; ?>
							  </td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            <!-- 循环文章扩展的字段 end -->
                        	<?php if($show_default_fields_status[9] == 1): ?><tr>
                                <th>文章内容：</th>
                                <td><textarea id="content" class="" style="height: 300px; width:80%;" name="info[content]"><?php echo ($article_info['content']); ?></textarea></td>
                            </tr><?php endif; ?>
                        </table>
						<?php if(get_action_name() == 'article_edit'): ?><input type="hidden" name="aid" value="<?php echo ($aid); ?>" /><?php endif; ?>
                        <input type='hidden' value="<?php echo ($cid); ?>" name='cid'/>
                    </form>
                    <div class="commonBtnArea" >
                        <button class="btn submit">提交</button>
                    </div>
                </div>
            </div>
        </div>
        <input type='hidden' value="<?php echo get_action_name(); ?>" id='get_action_name' />
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
            UE.getEditor('content')
        </script>
        <script type="text/javascript">
            $(function(){
                $(".submit").click(function(){
                    if($('#title').val()==''){
                        popup.error('标题不能为空！');
                        return false;
                    }
                    commonAjaxSubmit("");
                    return false;
                });
                //切换跳转
                $('.type_change').change(function(){
                	var now_cid = $(this).val();
                	var get_action_name = $('#get_action_name').val();
                	if(get_action_name == 'article_add'){
                    	window.location.href = "__URL__/article_add/cid/"+now_cid;
                	}
                });
                //随机点击量
                $("#jkd_random").click(function(){
                	var other_val =  Math.floor(Math.random()*1000);
                    $('#jkd_random_val').val(other_val);
                }); 
                //删除图片  
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
	              uploadJson : '__ROOT__/public/editors/kindeditor/php/upload_json.php?dirname=article',
	              fileManagerJson:'__ROOT__/public/editors/kindeditor/php/file_manager_json.php?dirname=article'
	              //sdl:false
	          });
	          K('#article_img').click(function() {
	              editor.loadPlugin('image', function() {
	                  editor.plugin.imageDialog({
	                      imageUrl : K('#article_img_val').val(),
	                      clickFn : function(url, title, width, height, border, align) {
	                          K('#article_img_val').val(url);
                              $('#article_img').css('background-image','url('+url+')').css('background-size','220px 160px');
	                          editor.hideDialog();
	                      }
	                  });
	              });
	          });
	      });
		</script>
    </body>
</html>