<?php
class ArticleExtendFieldesModel extends Model
{
 protected $tableName = 'article_extend_fields';
 protected $_validate = array(
        array('field_type', 'require', '字段类型必须', 0, '', 1),
		array('field_name', '', '已经存在该字段，不可重复添加', 0, 'unique', 1),
    );
}
?>