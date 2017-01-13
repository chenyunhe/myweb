
PHP数组相加和merge的区别
当key为string类型时：

<?php  
$arr1 = array('a'=>'PHP');  
$arr2 = array('a'=>'JAVA');  
//如果键名为字符，且键名相同，array_merge()后面数组元素值会覆盖前面数组元素值  
print_r(array_merge($arr1,$arr2)); //Array ( [a] => JAVA )  
//如果键名为字符，且键名相同，数组相加会将最先出现的值作为结果  
print_r($arr1+$arr2); //Array ( [a] => PHP )  


当key为数字类型时：
<?php  
$arr1 = array("C","PHP");  
$arr2 = array("JAVA","PHP");  
//如果键名为数字，array_merge()不会进行覆盖  
print_r(array_merge($arr1,$arr2));//Array ( [0] => C [1] => PHP [2] => JAVA [3] => PHP )  
//如果键名为数组，数组相加会将最先出现的值作为结果，后面键名相同的会被抛弃  
print_r($arr1+$arr2);//Array ( [0] => C [1] => PHP )  
?> 
