$(function () {

	$( 'tr[pid!=0]' ).show();
	
	//全部展开
	$( '.all_open' ).click( function () {
		$( 'table tr[pid!=0]' ).show();
		$( '.menu_open' ).html( '[-]' );
	});

	//全部关闭
	$( '.all_close' ).click( function () {
		$( 'table tr[pid!=0]' ).hide();
		$( '.menu_open' ).html( '[+]' );
	});

	/*
	 * 无辜失效，蛋疼+无语   hhe勒个hhe....
	 * $( '.open' ).toggle( function () {
		var index = $( this ).parents('tr').attr('id');
		$( 'tr[name=father_is_hidden_show_' + index + ']').hide();
		$( this ).html( '[+]' );
	}, function () {
		var index = $( this ).parents('tr').attr('id');
		$( 'tr[name=father_is_hidden_show_' + index + ']').show();
		$( this ).html( '[-]' );
	} );*/
	
	//脑残办法
	$('.menu_open').click(function(){
		var now_status = $(this).attr('now_status');
		if(now_status == 1){
			var index = $( this ).parents('tr').attr('id');
			$( 'tr[name=father_is_hidden_show_' + index + ']').hide();
			$( this ).html( '[+]' );
			$(this).attr('now_status', 2)
		}else{
			var index = $( this ).parents('tr').attr('id');
			$( 'tr[name=father_is_hidden_show_' + index + ']').show();
			$( this ).html( '[-]' );
			$(this).attr('now_status', 1)
		}
	});
	
	//添加顶级菜单 -- 默认pid:0
	$( '.add_top_menu' ).click( function () {
		$( this ).parents('tr').before("<tr><td class='open_close'></td><td class='show_sort'><input type='text' class='show_order_input input' value='100' name='addsort[]'></td><td class='menu_name'><div class='menu_one'><input type='text' class='nav_name_input input' value='新栏目名称' name='addname[]'><input type='hidden' name='pid[]' value='0'><a href='javascript:void(0);' class='deleterow' onclick='deleterow(this)'>&nbsp;&nbsp;删除</a></div></td><td class='menu_other'></td></tr>");
	});

});

/*
 * 添加二级菜单 -- 默认pid -> 传递过来
 * @param id -- 目标菜单ID
 *******************************************/
function add_two_menu(id){
	$( 'tr[id=' + id + ']' ).after("<tr><td class='open_close'></td><td class='show_sort'><input type='text' class='show_order_input input' value='100' name='addsort[]'></td><td class='menu_name'><div class='menu_two'><input type='text' class='nav_name_input input' value='新栏目名称' name='addname[]'><input type='hidden' name='pid[]' value='"+ id +"'><a href='javascript:void(0);' class='deleterow' onclick='deleterow(this)'>&nbsp;&nbsp;删除</a></div></td><td class='menu_other'></td></tr>");
}

/*
 * 添加三级菜单 -- 默认pid -> 传递过来
 * @param id -- 目标菜单ID
 *******************************************/
function add_three_menu(id){
	$( 'tr[id=' + id + ']' ).after("<tr><td class='open_close'></td><td class='show_sort'><input type='text' class='show_order_input input' value='100' name='addsort[]'></td><td class='menu_name'><div class='menu_three'><input type='text' class='nav_name_input input' value='新栏目名称' name='addname[]'><input type='hidden' name='pid[]' value='"+ id +"'><a href='javascript:void(0);' class='deleterow' onclick='deleterow(this)'>&nbsp;&nbsp;删除</a></div></td><td class='menu_other'></td></tr>");
}

/*
 * 添加四级菜单 -- 默认pid -> 传递过来
 * @param id -- 目标菜单ID
 *******************************************/
function add_four_menu(id){
	$( 'tr[id=' + id + ']' ).after("<tr><td class='open_close'></td><td class='show_sort'><input type='text' class='show_order_input input' value='100' name='addsort[]'></td><td class='menu_name'><div class='menu_four'><input type='text' class='nav_name_input input' value='新栏目名称' name='addname[]'><input type='hidden' name='pid[]' value='"+ id +"'><a href='javascript:void(0);' class='deleterow' onclick='deleterow(this)'>&nbsp;&nbsp;删除</a></div></td><td class='menu_other'></td></tr>");
}

//删除新增节点
function deleterow(obj) {
	var table = obj.parentNode.parentNode.parentNode.parentNode.parentNode;
	var tr = obj.parentNode.parentNode.parentNode;
	table.deleteRow(tr.rowIndex);
}

/*
 * 删除菜单
 * @param id -- 目标菜单ID
 * return bool __框架加载非法（放弃 -- code保留）
 */
function del_menu(id){
	var rs = confirm('本操作不可恢复，确认删除该菜单，并删除该菜单下所有子菜单？');
	if(rs){
		window.location.href = CONTROL + '/do_index/delid/' + id;
	}
}
