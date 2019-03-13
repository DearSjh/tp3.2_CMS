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

		<link rel="stylesheet" href="__PUBLIC__/menu/menu.css" />
		<script type="text/javascript" src="__PUBLIC__/menu/menu.js"></script>
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
                    <div class="contentArea">
	                    <div class="Item hr">
	                        <div class="current">栏目列表</div>
	                    </div>
	                    <div id='menu_open' >
							<a href="javascript:void(0);" class="all_open" style="margin-left:60px;color:#2366A8;">全部展开</a>&nbsp;|&nbsp;<a href="javascript:void(0);" class="all_close" style="color:#2366A8;">全部折叠</a>
						</div>
						<form action="" method="post">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab_menu">
								<thead>
									<tr pid="0">
										<td class='open_close'></td>
										<td class='show_sort'>显示顺序</td>
										<td class='menu_name'>栏目名称</td>
										<td class='menu_other'><span class='margin45'></span>操作</td>
									</tr>
								</thead>
								<tbody>
								
								<?php if(is_array($menu_list)): foreach($menu_list as $key=>$menu_one): ?><!--  顶级栏目  start-->
									<tr id="<?php echo ($menu_one["id"]); ?>" pid="0">
										<td class='open_close'><a href="javascript:void(0);" now_status='1' class="menu_open">[-]</a></td>
										<!-- 显示顺序   -->
										<td class='show_sort'><input type="text" class="show_order_input input" value="<?php echo ($menu_one["sort"]); ?>" name="sort[<?php echo ($menu_one["id"]); ?>]"></td>
										<td class='menu_name'>
											<div class="menu_one">
												<!-- 栏目名称  -->
												<input type="text" class="nav_name_input input" value="<?php echo ($menu_one["menu_name"]); ?>" name="name[<?php echo ($menu_one["id"]); ?>]">
												<!-- 栏目ID -->
												<a href="javascript:void(0);" onclick="add_two_menu(<?php echo ($menu_one["id"]); ?>);" class="add_two_menu">添加子栏目</a>						
											</div>
										</td>
										<td class='menu_other'>
											<!-- 顶级分类查看 -->
											<?php if($menu_one['content_model'] == 'article'): ?><a href="<?php echo U('Jkd/Article/article_list',array('cid'=>$menu_one['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_one['content_model'] == 'product'): ?><a href="<?php echo U('Jkd/Product/product_list',array('cid'=>$menu_one['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_one['content_model'] == 'page'): ?><a href="<?php echo U('Jkd/Page/page_data',array('cid'=>$menu_one['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_one['content_model'] == 'message'): ?><a href="<?php echo U('Jkd/Message/message_list',array('cid'=>$menu_one['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<a href="<?php echo U('Jkd/Menu/menu_edit',array('id'=>$menu_one['id']));?>" class="bt2">编辑</a>&nbsp;
											<!-- 字段管理 -->
											<?php if($menu_one['content_model'] == 'page'): ?><a href="<?php echo U('Jkd/Menu/menu_fields_manage',array('id'=>$menu_one['id']));?>" class="bt2">字段管理</a>&nbsp;<?php endif; ?>
											<!-- 顶级分类删除 -->
											<?php $now_developer_status = get_conf('IS_DEVELOPER'); ?>
											<?php if($now_developer_status == 1): ?><a link="<?php echo U('Jkd/Menu/del',array('id'=>$menu_one['id']));?>" href="javascript:void(0)" name="<?php echo ($menu_one["menu_name"]); ?>" class="del">删除</a><?php endif; ?>
										</td>
									</tr>
									<!--  顶级栏目  end-->
								
									<?php if(is_array($menu_one['child'])): foreach($menu_one['child'] as $key=>$menu_two): ?><!--  二级栏目  start-->
									<tr id="<?php echo ($menu_two["id"]); ?>" name="father_is_hidden_show_<?php echo ($menu_one["id"]); ?>">
										<td class='open_close'></td>
										<!-- 显示顺序   -->
										<td class='show_sort'>
											<input type="text" class="show_order_input input" value="<?php echo ($menu_two["sort"]); ?>" name="sort[<?php echo ($menu_two["id"]); ?>]">
										</td>
										<td class='menu_name'>
											<div class="menu_two">
												<!-- 栏目名称  -->
												<input type="text" class="nav_name_input input" value="<?php echo ($menu_two["menu_name"]); ?>" name="name[<?php echo ($menu_two["id"]); ?>]">
												<!-- 栏目ID -->
												<a href="javascript:void(0);" onclick="add_three_menu(<?php echo ($menu_two["id"]); ?>);" class="add_three_menu">添加子栏目</a>						</div>
										</td>
										<td class='menu_other'>
											<!-- 二级分类查看   -->
											<?php if($menu_two['content_model'] == 'article'): ?><a href="<?php echo U('Jkd/Article/article_list',array('cid'=>$menu_two['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_two['content_model'] == 'product'): ?><a href="<?php echo U('Jkd/Product/product_list',array('cid'=>$menu_two['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_two['content_model'] == 'page'): ?><a href="<?php echo U('Jkd/Page/page_data',array('cid'=>$menu_two['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_two['content_model'] == 'message'): ?><a href="<?php echo U('Jkd/Message/message_list',array('cid'=>$menu_two['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<a href="<?php echo U('Jkd/Menu/menu_edit',array('id'=>$menu_two['id']));?>" class="bt2">编辑</a>&nbsp;
											<!-- 字段管理 -->
											<?php if($menu_two['content_model'] == 'article' or $menu_two['content_model'] == 'product' or $menu_two['content_model'] == 'page'): ?><a href="<?php echo U('Jkd/Menu/menu_fields_manage',array('id'=>$menu_two['id']));?>" class="bt2">字段管理</a>&nbsp;<?php endif; ?>
											<!-- 栏目ID  -->
											<a link="<?php echo U('Jkd/Menu/del',array('id'=>$menu_two['id']));?>" href="javascript:void(0)" name="<?php echo ($menu_two["menu_name"]); ?>" class="del">删除</a>					
										</td>
									</tr>
									<!--  二级栏目  end-->
								
									<?php if(is_array($menu_two['child'])): foreach($menu_two['child'] as $key=>$menu_three): ?><!--  三级栏目   start-->
									<tr id="<?php echo ($menu_three["id"]); ?>" name="father_is_hidden_show_<?php echo ($menu_one["id"]); ?>">
										<td class='open_close'></td>
										<!-- 显示顺序   -->
										<td class='show_sort'><input type="text" class="show_order_input input" value="<?php echo ($menu_three["sort"]); ?>" name="sort[<?php echo ($menu_three["id"]); ?>]"></td>
										<td class='menu_name'>
											<div class="menu_three">
												<!-- 栏目名称  -->
												<input type="text" class="nav_name_input input" value="<?php echo ($menu_three["menu_name"]); ?>" name="name[<?php echo ($menu_three["id"]); ?>]">
												<!-- 栏目ID  -->
												<a href="javascript:void(0);" onclick="add_four_menu(<?php echo ($menu_three["id"]); ?>);" class="add_four_menu">添加子栏目</a>						</div>
										</td>
										<td class='menu_other'>
											<!-- 三级分类查看 -->
											<?php if($menu_three['content_model'] == 'article' or $menu_three['content_model'] == 'product'): ?><a href="<?php echo U('Jkd/Article/article_list',array('cid'=>$menu_three['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_three['content_model'] == 'page'): ?><a href="<?php echo U('Jkd/Page/page_data',array('cid'=>$menu_three['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_three['content_model'] == 'message'): ?><a href="<?php echo U('Jkd/Message/message_list',array('cid'=>$menu_three['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<a href="<?php echo U('Jkd/Menu/menu_edit',array('id'=>$menu_three['id']));?>" class="bt2">编辑</a>&nbsp;
											<?php if($menu_three['content_model'] == 'article'): ?><a href="<?php echo U('Jkd/Menu/menu_fields_manage',array('id'=>$menu_three['id']));?>" class="bt2">字段管理</a>&nbsp;<?php endif; ?>
											<!-- 栏目ID  -->
											<a link="<?php echo U('Jkd/Menu/del',array('id'=>$menu_three['id']));?>" href="javascript:void(0)" name="<?php echo ($menu_three["menu_name"]); ?>" class="del">删除</a>					
										</td>
									</tr>
									<!--  三级栏目  end-->
									
									<?php if(is_array($menu_three['child'])): $i = 0; $__LIST__ = $menu_three['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_four): $mod = ($i % 2 );++$i;?><!--  四级菜单 start-->
									<tr id="<?php echo ($menu_four["id"]); ?>" name="father_is_hidden_show_<?php echo ($menu_one["id"]); ?>">
										<td class='open_close'></td>
										<!-- 显示顺序   -->
										<td class='show_sort'>
											<input type="text" class="show_order_input input" value="<?php echo ($menu_four["sort"]); ?>" name="sort[<?php echo ($menu_four["id"]); ?>]">
										</td>
										<td class='menu_name'>
											<div class="menu_four">
											<!-- 菜单名称  -->
												<input type="text" class="nav_name_input input" value="<?php echo ($menu_four["menu_name"]); ?>" name="name[<?php echo ($menu_four["id"]); ?>]">
											</div>
										</td>
										<td class='menu_other'>
											<!-- 四级分类查看  -->
											<?php if($menu_four['content_model'] == 'article' or $menu_four['content_model'] == 'product'): ?><a href="<?php echo U('Jkd/Article/article_list',array('cid'=>$menu_four['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_four['content_model'] == 'page'): ?><a href="<?php echo U('Jkd/Page/page_data',array('cid'=>$menu_four['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<?php if($menu_four['content_model'] == 'message'): ?><a href="<?php echo U('Jkd/Message/message_list',array('cid'=>$menu_four['id']));?>" class="bt2">查看</a>&nbsp;<?php endif; ?>
											<a href="<?php echo U('Jkd/Menu/menu_edit',array('id'=>$menu_four['id']));?>" class="bt2">编辑</a>&nbsp;
											<?php if($menu_four['content_model'] == 'article'): ?><a href="<?php echo U('Jkd/Menu/menu_fields_manage',array('id'=>$menu_four['id']));?>" class="bt2">字段管理</a>&nbsp;<?php endif; ?>
											<!-- 菜单ID  -->
											<a link="<?php echo U('Jkd/Menu/del',array('id'=>$menu_four['id']));?>" href="javascript:void(0)" name="<?php echo ($menu_four["menu_name"]); ?>" class="del">删除</a>						
										</td>
									</tr>
									<!--  四级菜单 end--><?php endforeach; endif; else: echo "" ;endif; ?><!-- 四级菜单循环并结束判断  end  --><?php endforeach; endif; ?><!-- 三级菜单循环并结束判断  end  --><?php endforeach; endif; ?><!-- 二级菜单循环并结束判断  end  --><?php endforeach; endif; ?><!-- 顶级菜单循环 end  -->
				
									<tr pid="0">
										<td class='open_close'></td>
										<td class='show_sort'></td>
										<td class='menu_name'><a href="javascript:void(0);" class="add_top_menu">新栏目名称</a></td>	
										<td class='menu_other'></td>
									</tr>
								</tbody>
							</table>
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
		//更新栏目
        $(function(){
		    $(".submit").click(function(){
		        commonAjaxSubmit();
		    });
        });
		</script>
		<script type="text/javascript">
		//删除栏目
		    $(function(){
		        $(".del").click(function(){
		            var delLink=$(this).attr("link");
		            $this = $(this);
		            popup.confirm('删除的栏目必须无子栏目，且无数据！确定删除【<b>'+$(this).attr("name")+'</b>】吗?','温馨提示',function(action){
		                if(action == 'ok'){
		                    delByLink(delLink, $this);
		                }
		            });
		            return false;
		        });
		    });
		</script>
    </body>
</html>