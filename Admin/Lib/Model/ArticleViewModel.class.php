<?php
class ArticleViewModel extends ViewModel{
	protected $viewFields = array(
		'article' => array(
			'id','title','keywords','description','status','summary','published','update_time','content','lang','click','is_m',
			'_type' => 'LEFT'		
		),
		 'menu' => array(
		 	'menu_name',
		 	'_on' => 'article.cid = menu.id'
		 )
	);
	
	
}