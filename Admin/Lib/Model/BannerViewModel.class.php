<?php
class BannerViewModel extends ViewModel{
	protected $viewFields = array(
		'banner' => array(
			'id','explain'=> 'title','img_src','img_alt','url','sort','publish_time',
			'_type' => 'LEFT'		
		),
		 'banner_menu' => array(
		 	'menu_name',
		 	'_on' => 'banner.type = banner_menu.id'
		 )
	);
	
	
}