<?php
/**
 * Created by PhpStorm.
 * User: chenyunhe
 * Date: 2016/10/18
 * Time: 17:19
 * DESC:导出csv文件
 */
$arr = array(
    array('title'=>'title','name'=>'test'),
    array('title'=>'title','name'=>'test'),
);
array_unshift($arr,array('title','name',));
outputCSV($arr,'csvname');

/**
 * @desc 导出CSV文件
 * @param $data array() 数据数组 如 array( array(1,2,3), array(1,2,3) );
 * @param $name string 文件名 如
 * @return 导出CSV文件
 */
function outputCSV($data,$name)
{
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename={$name}.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $outputBuffer = fopen("php://output", 'w');
    foreach($data as $val)
    {
        foreach ($val as $key => $val2)
        {
            $val[$key] = iconv('utf-8', 'gbk', $val2);// CSV的Excel支持GBK编码，一定要转换，否则乱码
        }
        fputcsv($outputBuffer, $val);
    }
    fclose($outputBuffer);
}
