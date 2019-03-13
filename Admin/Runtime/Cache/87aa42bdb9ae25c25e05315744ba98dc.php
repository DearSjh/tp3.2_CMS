<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>管理员登陆中心</title>
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

    <link rel="stylesheet" type="text/css" href="__PUBLIC__/login/login.css"/>
	<!-- tips -->
	<script type="text/javascript" src="__ROOT__/public/style/common/jquery-1.8.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="__ROOT__/public/style/common/tips/asyncbox/skins/default.css" />
	<script type="text/javascript" src="__ROOT__/public/style/common/tips/functions.js"></script>
	<script type="text/javascript" src="__ROOT__/public/style/common/tips/jquery.form.js"></script>
	<script type="text/javascript" src="__ROOT__/public/style/common/tips/jquery.lazyload.js"></script>
	<script type="text/javascript" src="__ROOT__/public/style/common/tips/asyncbox/asyncbox.js"></script>
	<script type='text/javascript'>
		$(function(){
			$('.login_container').animate({right:"0"},800);
			
			//回车触发表单提交事件
			$(this).keydown(function(e){
				if(e.which == 13){
				    commonAjaxSubmit();
				}				
			});

			//安全问题
		    $('#login_select').click(function(){
		        $('.form_row ul').show();
		        event.cancelBubble = true;
		    })
		    
		    $('#login_select').focus(function(){
		        $('.form_row ul').show();
		        event.cancelBubble = true;
		    })

		    $('#d').click(function(){
		        $('.form_row ul').toggle();
		        event.cancelBubble = true;
		    })

		    $('body').click(function(event){
				if(event.target==this){
					$('.form_row ul').hide();
				}
			})

		    $('.form_row li').click(function(){
		        var v  = $(this).text();
		        var li_class = $(this).attr('class');
		        $('#question_id').val(li_class);
		        $('#login_select').val(v);
		        $('.form_row ul').hide();
		    })
			
		});
	</script>
	
</head>
<body>
<div id='container' >
	<div class='login_container' >
	    <h1 class='login_title'>管理员登陆</h1>
	    <img src='__PUBLIC__/login/img/people.png' id='admin'/>
	    <div id="login_forms" class="login_forms clearfix">
	        <form class="login_form_form" id="login_form" method="post" action="" name='admin_login_form'>
	            <div class="form_row first_row">
	                <input type="text" name="login_username" placeholder="请输入用户名" id="login_username" >
	            </div>
	            <div class="form_row">
	                <input type="password" name="login_password" placeholder="请输入密码" id="login_password" >
	            </div>
	            <div class="form_row">
	                <input type="text" name="question_answer" placeholder="请输入安全问题" id="login_password" >
	            </div>
	            <div class="form_row">
				    <input type="text" name="user[password]" placeholder="请选择安全提问" id="login_select" value="" data-required="required">
				    <img src="__PUBLIC__/login/img/d.png" id="d">
					<ul>
						<li class='1'>母亲的名字</li>
						<li class='2'>爷爷的名字</li>
						<li class='3'>父亲出生的城市</li>
						<li class='4'>您其中一位老师的名字</li>
						<li class='5'>您个人计算机的型号</li>
						<li class='6'>您最喜欢的餐馆名称</li>
				    </ul>
				</div>
				<input type='hidden' value='' name='question_id' id='question_id'/>
	       </form>
	    </div>
	    <div class="login-btn-set">
	        <!--  <div class='rem'><input type='checkbox' name='remember_me' >记住我</div>  -->
            <!-- 登陆按钮图片 -->
            <input type="button" class='login-btn submit' />
	    </div>
	    <p class='copyright'>版权所有 <?php echo C('site_title');?></p>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(".submit").click(function(){
	    commonAjaxSubmit();
	});
});
</script>
</body>
</html>