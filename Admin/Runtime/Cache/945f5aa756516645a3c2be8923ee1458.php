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
			<li <?php if(MODULE_NAME == 'TplCenter'): ?>class="current"<?php endif; ?>>
				<span><a href="<?php echo U('TplCenter/index');?>">模板管理</a></span>
			</li>
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
                        <div class="current">文章列表</div>
                        <?php if(empty($is_top_menu_true)): ?><div style="width: 100px;float: right;">
	                    	<button type="button" class="btn" onclick="window.location.href='<?php echo U('Jkd/Article/article_add', array('cid' => $cid));?>'">添加文章</button>
	                    </div><?php endif; ?>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
                        <thead>
                            <tr>
                                <td>新闻标题</td>
                                <td>所在分类</td>
                                <td>发布时间</td>
                                <td>状态</td>
                                <td>手机状态</td>
                                <td width="150">操作</td>
                            </tr>
                        </thead>
                        <?php if(is_array($article_list)): $i = 0; $__LIST__ = $article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jkd): $mod = ($i % 2 );++$i;?><tr align="center" id="<?php echo ($jkd["id"]); ?>">
                                <td align="left">
                                	<img src="__PUBLIC__/img/<?php echo ($jkd["lang"]); ?>.png">
                                	<a href="javascript:void(0);"><?php echo ($jkd["title"]); ?></a>
                                </td>
                                <td><?php echo ($jkd["menu_name"]); ?></td>
                                <td><?php echo (date("Y-m-d H:i:s",$jkd["published"])); ?></td>
                                <td>
                                	<a href="javascript:void(0);" onclick="changeStatus(<?php echo ($jkd["id"]); ?>,this)">
                                		<?php if($jkd['status'] == 0): ?>待审核<?php endif; ?>
                                		<?php if($jkd['status'] == 1): ?>已发布<?php endif; ?>
                                	</a>
                                </td>
                                <td>
                                	<a href="javascript:void(0);" onclick="changeAttr(<?php echo ($jkd["id"]); ?>,this)">
                                		<img src="__PUBLIC__/img/iphone-<?php echo ($jkd["is_m"]); ?>.png" title='单击切换当前显示状态' border="0">
                                	</a>
                                </td>
                                <td>
                                	[ <a href="<?php echo U('Jkd/Article/article_copy', array('aid' => $jkd['id'], 'cid' => $cid));?>">复制 </a> ]
                                	[ <a href="<?php echo U('Jkd/Article/article_edit', array('aid' => $jkd['id'], 'cid' => $cid));?>">编辑 </a> ] 
                                	[ <a link="<?php echo U('Jkd/Article/del/',array('id'=>$jkd['id']));?>" href="javascript:void(0)" name="<?php echo ($jkd["title"]); ?>" class="del">删除 </a> ]
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <tr><td colspan="7" align="right"><?php echo ($page); ?></td></td></tr>
                        <tr>
                        	<td colspan="7" align="left">
                            <form action="<?php echo U('Jkd/Article/article_list');?>" method="get">
								标题：<input type="text" name="title" value="<?php echo ($s_title); ?>" size="30" style="margin-right: 20px;">
                           		分类：<select name="cid" style="margin-right: 20px;">
                            			<option value="">--请选择--</option>
                                			<?php if(is_array($menu_list)): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jkd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($jkd["id"]); ?>" <?php if($jkd['id'] == $cid): ?>selected='selected'<?php endif; ?>><?php echo ($jkd["menu_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            			</select>
                            	状态：<select name="status" style="margin-right: 20px;">
		                           		<option value="">--请选择--</option>
		                                <option value="1" <?php if($s_status == 1): ?>selected='selected'<?php endif; ?>>已发布</option>
		                                <option value="2" <?php if($s_status == 2): ?>selected='selected'<?php endif; ?>>未审核</option>
		                        	</select>
								手机状态：<select name="is_m" style="margin-right: 20px;">
		                            	<option value="">--请选择--</option>
		                                <option value="1" <?php if($s_is_m == 1): ?>selected='selected'<?php endif; ?>>显示</option>
		                                <option value="2" <?php if($s_is_m == 2): ?>selected='selected'<?php endif; ?>>隐藏</option>
									</select>
									<input type='hidden' value='<?php echo ($cid); ?>' name='h_cid' /> 
                            		<input type="submit" value="搜索" class='sub'>&nbsp;&nbsp;&nbsp;
                       		 		<?php if(empty($is_top_menu_true)): ?><input type="button" value="添加文章" class='sub' onclick="window.location.href='<?php echo U('Jkd/Article/article_add', array('cid' => $cid));?>'" /><?php endif; ?>
                            </form>
                        	</td>
                        </tr>
                    </table>
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
		        commonAjaxSubmit();
		    });

	        $(".del").click(function(){
	            var delLink=$(this).attr("link");
	            $this = $(this);
	            popup.confirm('确定删除【<b>'+$(this).attr("name")+'</b>】，确定?','温馨提示',function(action){
	                if(action == 'ok'){
	                    delByLink(delLink, $this);
	                }
	            });
	            return false;
	        });
	        
        });
        function changeAttr(id,v){
            $.get("__URL__/changeAttr/id/"+id,function(data){
                if(data.status == 1){
                    $(v).html(data.info);
                }
            }, 'json');
        }
        function changeStatus(id,v){
            $.get("__URL__/changeStatus/id/"+id,function(data){
                if(data.status==1){
                    $(v).html(data.info);
                }
            }, 'json');
        }
		</script>
    </body>
</html>