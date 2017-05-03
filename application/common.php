<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 导出excle
function export_to($data,$name=false,$type = 0){
    if(!$name){$name=date("Y-m-d-H-i-s",time());}
    $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
    $PHPExcel->getActiveSheet()->fromArray($data);
    $PHPExcel->getActiveSheet()->setTitle('Sheet1'); //给当前活动sheet设置名称
    $PHPExcel->setActiveSheetIndex(0);
    $fileName = './public/'.date('Y-m-d_', time()).time().'.xlsx';
    $saveName = $name.date('Y-m-d', time()).'.xlsx';

    $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel,'Excel5');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，‘Excel5’表示生成2003版本Excel文件
    if ($type == 0) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
        header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header('Content-Disposition: attachment;filename="'.$saveName.'"');//告诉浏览器输出浏览器名称
        // header('Content-Disposition: attachment;filename="01simple.xlsx"');//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $PHPWriter->save("php://output");
    }else{
        $PHPWriter->save($fileName); //表示在$path路径下面生成demo.xlsx文件
    }
}

function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $keys = 'id', $sort = 'asc', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $list[$key][$child] = [];
            $refer [$data[$pk]] = &$list[$key];
        }

        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree [] = &$list[$key];
                $tree = my_sort($tree,$keys,$sort,SORT_NUMERIC);
            } else {
                if (isset ($refer [$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child] [] = &$list[$key];
                    $parent[$child] = my_sort($parent[$child],$keys,$sort,SORT_NUMERIC);
                }
            }
        }
    }
    return $tree;
}
/**
 * 数组按字段排序
 * @param  $arrays  要排序的数组
 * @return SORT_ASC     - 默认，按升序排列。(A-Z)
 * @return SORT_DESC    - 按降序排列。(Z-A)
 * @return SORT_REGULAR - 默认。将每一项按常规顺序排列。
 * @return SORT_NUMERIC - 将每一项按数字顺序排列。
 * @return SORT_STRING  - 将每一项按字母顺序排列
 * @author 清月曦 <1604583867@qq.com>
 */
function my_sort($arrays,$sort_key,$sort_order='asc',$sort_type=SORT_NUMERIC ){
    if($sort_order == 'asc') $sort_order=SORT_ASC;
    if($sort_order == 'desc') $sort_order=SORT_DESC;

    if(is_array($arrays)){   
        foreach ($arrays as $array){   
            if(is_array($array)){   
                $key_arrays[] = $array[$sort_key];   
            }else{   
                return false;   
            }   
        }   
    }else{   
        return false;   
    }  
    array_multisort($key_arrays,$sort_order,$sort_type,$arrays);   
    return $arrays;   
} 
/**
 * 及时显示提示信息
 * @param  string $msg 提示信息
 */
function show_msg($msg, $class = ''){
    echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"{$class}\")</script>";
    flush();
    ob_flush();
}
/**
 * 执行SQL文件
 */
function execute_sql_file($sql_path)
{
    // 读取SQL文件
    $sql = wp_file_get_contents($sql_path);
    $sql = str_replace("\r", "\n", $sql);
    $sql = explode(";\n", $sql);

    // 替换表前缀
    $orginal = 'wemall_';
    $prefix = config('DB_PREFIX');
    $sql = str_replace("{$orginal}", "{$prefix}", $sql);

    // 开始安装
    foreach ($sql as $value) {
        $value = trim($value);
        if (empty ($value))
            continue;

        $res = \think\Db::execute($value);
    }
}
