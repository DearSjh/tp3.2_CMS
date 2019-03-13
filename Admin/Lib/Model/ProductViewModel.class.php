<?php
class ProductViewModel extends ViewModel{
	protected $viewFields = array(
		'product' => array(
			'id','title','keywords','description','status','summary','published','update_time','content','lang','click','is_m',
			'_type' => 'LEFT'		
		),
		 'menu' => array(
		 	'menu_name',
		 	'_on' => 'product.cid = menu.id'
		 )
	);
	
	
}