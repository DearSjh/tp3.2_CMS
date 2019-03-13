<?php

Class Category {

	/*
	 * 递归重新排序无限极分类数组
	 * 组合一维数组
	 */
	static public function merge_one_array($cate,$pid = 0,$level = 0,$html = '&nbsp;&nbsp;&nbsp;&nbsp;--'){
		$arr = array();
		foreach ($cate as $v){
			if($v['pid'] == $pid ){
				$v['level'] = $level + 1 ;
				$v['html'] = str_repeat($html, $level);
				$arr[] = $v;
				$arr = array_merge($arr,self::merge_one_array($cate,$v['id'],$level+1));
			}
		}
		return $arr;
	}
	

	/*
	 * 递归重新排序无限极分类数组
	 * 组合多维数组
	 */
	static public function merge_many_array($cate,$pid = 0){
		$arr = array();
		foreach ($cate as $v){
			if ($v['pid'] == $pid){
				$v['child'] = self::merge_many_array($cate,$v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}
	
	
	/*
	 * 传递一个子分类ID返回所有的父级分类
	 * @param <array> $cate 数据库读取 
	 * @param <int> $id 待查找的ID
	 * @return array 
	 */
	Static Public function get_all_parentsId($cate, $id){
		$arr = array();
		foreach($cate as $v){
			if($v['id'] == $id){
				$arr[] = $v;
				$arr = array_merge( self::get_all_parentsId($cate, $v['pid']) ,$arr);	
			}
		}
		return $arr;
	}
	
	/*
	 * 传递一个子分类ID返回最后一个的父级分类
	* @param <array> $cate 数据库读取
	* @param <int> $id 待查找的ID
	* @return array
	*/
	Static Public function get_all_last_parentsId($cate, $id){
		$arr = array();
		foreach($cate as $v){
			if($v['id'] == $id){
				$arr[] = $v;
				if(!empty($v['pid'])){
					$arr = array_merge( self::get_all_last_parentsId($cate, $v['pid']) ,$arr);
				}else{
					$arr = $v;
				}
			}
		}
		return $arr;
	}
	

	/*
	 * 传递一个父级分类ID返回所有子分类ID
	 * @param <array> $cate 数据库读取 
	 * @param <int> $id 待查找的ID
	 * @return array 
	 */
	Static Public function get_all_childsId($cate, $id){
		$arr = array();
		foreach($cate as $v){
			if($v['pid'] == $id){
				$arr[] = $v['id'];
				$arr = array_merge($arr, self::get_all_childsId($cate, $v['id']));
			}
		}
		return $arr;
	}
        
}