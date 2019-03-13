<?php
/**
 * 数据库管理  -- Controller
 *********************************/
class DatabaseAction extends CommonAction {

/**
  * +----------------------------------------------------------
  * 列出系统中所有数据库表信息
  * +----------------------------------------------------------*/
    public function database_list(){
    	$db = M();
        $tabs = $db->query('SHOW TABLE STATUS'); //获取表信息
        $total = 0;
        foreach ($tabs as $k => $v) {
            $tabs[$k]['size'] = byteFormat($v['Data_length'] + $v['Index_length']);
            $total+=$v['Data_length'] + $v['Index_length'];
        }
        $this->assign("table_list", $tabs);			
        $this->assign("table_total", byteFormat($total));
        $this->assign("table_count", count($tabs));
        $this->display();
    }
    
    
/**
 *+----------------------------------------------------------
 * 备份数据库
 *+----------------------------------------------------------*/
    public function backup() {
    	if (IS_POST){

    		header('Content-Type:application/json; charset=utf-8');
    		$M = M();
    		function_exists('set_time_limit') && set_time_limit(0); //设置允许脚本运行的时间,防止备份数据过程超时
    		$tables = empty($_POST['table']) ? array() : $_POST['table'];
    		if (count($tables) == 0) {
    			die(json_encode(array("status" => 0, "info" => "请先选择要备份的表")));
    		}
    		$time = time();
    			$type = "管理员后台手动备份";
    			//123
    			$path = DatabaseBackDir . "/CUSTOM_" . date("Ymd") . "_" . randCode(5);
    		$pre = "# -----------------------------------------------------------\n" .
    				"# 9+ lansquenet  database backup files\n" .
    				"# Blog: http://www.9koudai.net\n" .
    				"# Type: {$type}\n";
    		
    		$bdTable = D("JkdDatabase")->bakupTable($tables); //取得表结构信息
    		$outPut = "";
    		$file_n = 1;
    		$backedTable = array();
    		foreach ($tables as $table) {
    			$backedTable[] = $table;
    			$outPut.="\n\n# 数据库表：{$table} 数据信息\n";
    			$tableInfo = $M->query("SHOW TABLE STATUS LIKE '{$table}'");
    			$page = ceil($tableInfo[0]['Rows'] / 10000) - 1;
    			for ($i = 0; $i <= $page; $i++) {
    				$query = $M->query("SELECT * FROM {$table} LIMIT " . ($i * 10000) . ", 10000");
    				foreach ($query as $val) {
    					$temSql = "";
    					$tn = 0;
    					$temSql = '';
    					foreach ($val as $v) {
    						$temSql.=$tn == 0 ? "" : ",";
    						$temSql.=$v == '' ? "''" : "'{$v}'";
    						$tn++;
    					}
    					$temSql = "INSERT INTO `{$table}` VALUES ({$temSql});\n";
    		
    					$sqlNo = "\n# Time: " . date("Y-m-d H:i:s") . "\n" .
    							"# -----------------------------------------------------------\n" .
    							"# 当前SQL卷标：#{$file_n}\n# -----------------------------------------------------------\n\n\n";
    					if ($file_n == 1) {
    						$sqlNo = "# Description:当前SQL文件包含了表：" . implode("、", $tables) . "的结构信息，表：" . implode("、", $backedTable) . "的数据" . $sqlNo;
    					} else {
    						$sqlNo = "# Description:当前SQL文件包含了表：" . implode("、", $backedTable) . "的数据" . $sqlNo;
    					}
    					if (strlen($pre) + strlen($sqlNo) + strlen($bdTable) + strlen($outPut) + strlen($temSql) > C("sqlFileSize")) {
    						$file = $path . "_" . $file_n . ".sql";
    						$outPut = $file_n == 1 ? $pre . $sqlNo . $bdTable . $outPut : $pre . $sqlNo . $outPut;
    						file_put_contents($file, $outPut, FILE_APPEND);
    						$bdTable = $outPut = "";
    						$backedTable = array();
    						$backedTable[] = $table;
    						$file_n++;
    					}
    					$outPut.=$temSql;
    				}
    			}
    		}
    		if (strlen($bdTable . $outPut) > 0) {
    			$sqlNo = "\n# Time: " . date("Y-m-d H:i:s") . "\n" .
    					"# -----------------------------------------------------------\n" .
    					"# 当前SQL卷标：#{$file_n}\n# -----------------------------------------------------------\n\n\n";
    			if ($file_n == 1) {
    				$sqlNo = "# Description:当前SQL文件包含了表：" . implode("、", $tables) . "的结构信息，表：" . implode("、", $backedTable) . "的数据" . $sqlNo;
    			} else {
    				$sqlNo = "# Description:当前SQL文件包含了表：" . implode("、", $backedTable) . "的数据" . $sqlNo;
    			}
    			$file = $path . "_" . $file_n . ".sql";
    			$outPut = $file_n == 1 ? $pre . $sqlNo . $bdTable . $outPut : $pre . $sqlNo . $outPut;
    			file_put_contents($file, $outPut, FILE_APPEND);
    			$file_n++;
    		}
    		$time = time() - $time;
    		echo json_encode(array("status" => 1, "info" => "成功备份所选数据库表结构和数据，本次备份共生成了" . ($file_n - 1) . "个SQL文件。耗时：{$time} 秒", "url" => U('Database/database_list')));
    		
    	}else{
    		echo json_encode(array("status" => 0, "info" => "非法操作"));
    	}
    		
    }
    
}