$(function(){

	// 返回顶部效果
	var back_timer = '';
	$(window).scroll(function(){
		var top = $(window).scrollTop();
		(top>100)?$('.back_top').show():$('.back_top').hide();

	})

	
	$('.back_top a').click(function(){
		back_timer = setInterval(function(){
			$(window).scrollTop($(window).scrollTop()-10);
			if($(window).scrollTop()<=0){
				clearInterval(back_timer);
			}
		},1)
	})

})